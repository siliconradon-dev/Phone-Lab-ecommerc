<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CleanBuyNowSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->is('checkout')) {
            session()->forget('buy_now_item');
        }
        return $next($request);
    }
}
