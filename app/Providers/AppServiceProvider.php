<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   

     
        $settings = Cache::remember('site_settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });

        Config::set('settings', $settings);

        View::share('siteSettings', $settings);

        View::share('globalCategories', Category::orderBy('name', 'asc')->get());

        View::composer('*', function ($view) {
            $userId = Auth::guard('public_user')->id();
            $sessionId = Request::cookie('cart_session_id');

            $cartQuery = Cart::with(['product.hotDeal', 'variant'])->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('public_user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            });

            $cartItems = $cartQuery->get();

            $cartCount = $cartItems->sum('quantity');

            $cartTotal = $cartItems->reduce(function ($total, $item) {
                $price = $item->variant ? $item->variant->active_price : $item->product->active_price;
                return $total + ($price * $item->quantity);
            }, 0);

            $view->with([
                'globalCartCount' => $cartCount,
                'globalCartTotal' => $cartTotal
            ]);
        });
    }
}
