<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicUserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\PosOrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\WebServiceController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name('phone_lab.index');
Route::get('/about', [HomeController::class, "goToAbout"])->name('phone_lab.about');
Route::get('/contact', [HomeController::class, "goToContact"])->name('phone_lab.contact');
Route::get('/shop', [HomeController::class, "goToShop"])->name('phone_lab.shop_grid');
Route::get('/product/{id}/{slug}', [HomeController::class, "productDetails"])->name('product.details');

Route::get('/order_tracking.html', [HomeController::class, 'orderTracking'])->name('phone_lab.order_tracking');

// Submit review
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('reviews.show');

// Route::view('/', 'phone_lab.pages.index')->name('home');
// Route::view('/index.html', 'phone_lab.pages.index')->name('phone_lab.index');
// Route::view('/about.html', 'phone_lab.pages.other.about')->name('phone_lab.about');
Route::view('/account.html', 'phone_lab.pages.other.account')->name('phone_lab.account');
Route::view('/blog.html', 'phone_lab.pages.other.blog')->name('phone_lab.blog');
Route::view('/blog.html.html', 'phone_lab.pages.other.blog_html')->name('phone_lab.blog_html');
Route::view('/blog_html.html', 'phone_lab.pages.other.blog_html')->name('phone_lab.blog_html_alias');
Route::view('/blog_details.html', 'phone_lab.pages.other.blog_details')->name('phone_lab.blog_details');
Route::view('/blog_grid.html', 'phone_lab.pages.other.blog_grid')->name('phone_lab.blog_grid');
Route::view('/blog_list.html', 'phone_lab.pages.other.blog_list')->name('phone_lab.blog_list');
Route::view('/blog_masonry.html', 'phone_lab.pages.other.blog_masonry')->name('phone_lab.blog_masonry');
Route::view('/cart.html', 'phone_lab.pages.other.cart')->name('phone_lab.cart');
Route::view('/cart_empty.html', 'phone_lab.pages.other.cart_empty')->name('phone_lab.cart_empty');
Route::view('/compare.html', 'phone_lab.pages.other.compare')->name('phone_lab.compare');
// Route::view('/contact.html', 'phone_lab.pages.other.contact')->name('phone_lab.contact');
Route::view('/error.html', 'phone_lab.pages.other.error')->name('phone_lab.error');
Route::view('/index_1.html', 'phone_lab.pages.other.index_1')->name('phone_lab.index_1');
Route::view('/index_2.html', 'phone_lab.pages.other.index_2')->name('phone_lab.index_2');
Route::view('/index_3.html', 'phone_lab.pages.other.index_3')->name('phone_lab.index_3');

Route::view('/product_details.html', 'phone_lab.pages.other.product_details')->name('phone_lab.product_details');
Route::view('/register.html', 'phone_lab.pages.other.register')->name('phone_lab.register');
Route::view('/rtl/index.html', 'phone_lab.pages.rtl.index')->name('phone_lab.rtl.index');
Route::view('/rtl/index_2.html', 'phone_lab.pages.rtl.index_2')->name('phone_lab.rtl.index_2');
Route::view('/rtl/index_3.html', 'phone_lab.pages.rtl.index_3')->name('phone_lab.rtl.index_3');
Route::view('/shop.html', 'phone_lab.pages.other.shop')->name('phone_lab.shop');
Route::view('/shop_details.html', 'phone_lab.pages.other.shop_details')->name('phone_lab.shop_details');
// Route::view('/shop_grid.html', 'phone_lab.pages.other.shop_grid')->name('phone_lab.shop_grid');
Route::view('/shop_list.html', 'phone_lab.pages.other.shop_list')->name('phone_lab.shop_list');
Route::view('/team.html', 'phone_lab.pages.other.team')->name('phone_lab.team');
Route::view('/wishlist.html', 'phone_lab.pages.other.wishlist')->name('phone_lab.wishlist');

Route::prefix('user')->group(function () {
    Route::get('/login', [PublicUserController::class, "publicLoginPage"])->name('user.login');
    Route::post('/login', [PublicUserController::class, "AuthLogin"])->name('user.login.submit');
    Route::post('/register', [PublicUserController::class, "register"])->name('user.register.submit');
    Route::get('/verify/{token}', [PublicUserController::class, "verify"])->name('user.verify');
    Route::get('/dashboard', [PublicUserController::class, "goToDashboard"])->name('user.dashboard');
    Route::post('/logout', [PublicUserController::class, "logout"])->name('user.logout');

    Route::post('/address/store', [PublicUserController::class, "storeAddress"])->name('addresses.store');
    Route::get('/address/delete/{id}', [PublicUserController::class, 'deleteAddress'])->name('address.delete');
    
    Route::post('/profile/update', [PublicUserController::class, "updateAccount"])->name('account.update');
    Route::post('/password/update', [PublicUserController::class, "updatePassword"])->name('account.password.update');

    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store')->named('feedback.store');
    Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
});

// Google Authentication Routes
Route::get('/auth/google', [PublicUserController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [PublicUserController::class, 'handleGoogleCallback']);

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('phone_lab.checkout');
    Route::POST('/buy-now/checkout', [CheckoutController::class, 'buyNowCheckout'])->name('checkout.buyNow');
    Route::post('/buy-now', [CheckoutController::class, 'buyNow'])->name('phone_lab.buy_now');
    Route::post('/store', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/payment/success', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [CheckoutController::class, 'paymentCancel'])->name('payment.cancel');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, "index"])->name('admin.dashboard');

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, "index"])->name('products.index');
            Route::get('/search', [ProductController::class, "search"])->name('products.search');
            Route::get('/all', [ProductController::class, "all"])->name('products.all');
            Route::get('/create', [ProductController::class, "create"])->name('products.create');
            Route::get('/get-brands/{category_id}', [ProductController::class, 'getBrands'])->name('get.brands');
            Route::post('/store', [ProductController::class, "store"])->name('products.store');
            Route::get('/view/{id}/{slug}', [ProductController::class, "view"])->name('products.view');
            Route::get('/edit/{id}', [ProductController::class, "edit"])->name('products.edit');
            Route::put('/update/{id}', [ProductController::class, "update"])->name('products.update');
        });

        Route::prefix('stocks')->group(function () {
            Route::get('/', [StockController::class, "index"])->name('stocks.index');
            Route::get('/create', [StockController::class, "create"])->name('stocks.create');
            Route::post('/store', [StockController::class, "store"])->name('stocks.store');
            Route::get('/get-product-variants/{productId}', [StockController::class, 'getVariants'])->name('stocks.get_variants');
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, "index"])->name('categories.index');
            Route::post('/store', [CategoryController::class, "store"])->name('categories.store');
            Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::post('/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
        });

        Route::prefix('brands')->group(function () {
            Route::get('/', [BrandController::class, "index"])->name('brands.index');
            Route::get('/all', [BrandController::class, "all"])->name('brands.all');
            Route::get('/create', [BrandController::class, "create"])->name('brands.create');
            Route::post('/store', [BrandController::class, "store"])->name('brands.store');
            Route::get('/{id}/edit', [BrandController::class, 'edit'])->name('brands.edit');
            Route::post('/{id}/update', [BrandController::class, 'update'])->name('brands.update');
        });

        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, "index"])->name('orders.index');
            Route::get('/show/{id}', [OrderController::class, "show"])->name('orders.show');
            Route::post('/tracking/{id}', [OrderController::class, "updateTracking"])->name('orders.updateTracking');
            Route::post('/complete/{id}', [OrderController::class, "completeOrder"])->name('orders.complete');
            Route::post('/{id}/update-payment', [OrderController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus');
        });

        Route::prefix('pos')->group(function () {
            Route::get('/', [PosController::class, "index"])->name('pos.index');
            Route::get('/get-variants/{id}', [PosController::class, 'getVariants']);
            Route::get('/get-available-imeis/{productId}/{variantId?}', [PosController::class, 'getAvailableImeis']);
            Route::post('/checkout', [PosController::class, 'checkout'])->name('admin.pos.checkout');
            Route::get('/invoice/{orderId}', [PosController::class, 'printInvoice'])->name('admin.pos.print-invoice');
        });

        Route::prefix('customers')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
            Route::post('/create', [CustomerController::class, 'addCustomer'])->name('customers.create');
            Route::put('/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
        });

        Route::prefix('pos-orders')->group(function () {
            Route::get('/', [PosOrderController::class, "index"])->name('pos-orders.index');
            Route::get('/show/{id}', [PosOrderController::class, "show"])->name('pos-orders.show');
            Route::get('/print-invoice/{orderId}', [PosOrderController::class, 'printInvoice'])->name('pos-orders.print-invoice');
        });

        Route::prefix('testimonials')->group(function () {
            Route::get('/', [TestimonialController::class, 'index'])->name('testimonials.index');
            Route::post('/create', [TestimonialController::class, 'store'])->name('testimonials.store');
            Route::put('/update/{id}', [TestimonialController::class, 'update'])->name('testimonials.update');
        });

        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'edit'])->name('settings.edit');
            Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
        });

        // Web Service routes (Banners, Discounts, New Arrivals, Hot Deals)
        Route::resource('banners', BannerController::class);
        Route::prefix('web-service')->group(function () {
            Route::get('discount', [WebServiceController::class, 'discountIndex'])->name('admin.web-service.discount');
            Route::post('discount/toggle', [WebServiceController::class, 'discountToggle'])->name('admin.web-service.discount.toggle');

            Route::get('new-arrivals', [WebServiceController::class, 'newArrivalsIndex'])->name('admin.web-service.new-arrivals');
            Route::post('new-arrivals/toggle', [WebServiceController::class, 'newArrivalsToggle'])->name('admin.web-service.new-arrivals.toggle');
            Route::post('new-arrivals/banner-update', [WebServiceController::class, 'updateNewArrivalsBanner'])->name('admin.web-service.new-arrivals.banner');

            Route::get('hot-deals', [WebServiceController::class, 'hotDealsIndex'])->name('admin.web-service.hot-deals');
            Route::post('hot-deals/toggle', [WebServiceController::class, 'hotDealsToggle'])->name('admin.web-service.hot-deals.toggle');
        });
    });
});

Route::get('/run-migrations', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Migrations and seeders ran successfully.',
            'output' => Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});
