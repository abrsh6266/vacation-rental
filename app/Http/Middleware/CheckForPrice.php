<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Symfony\Component\HttpFoundation\Response;

class CheckForPrice
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->url('products/pay') || $request->url('products/success')
        ) {
            if (Session::get('price') == 0) {
                return abort('403');
            }
        }
        return $next($request);
    }
}
