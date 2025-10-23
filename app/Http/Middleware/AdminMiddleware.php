<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 1) {
            // Nếu là admin, tiếp tục request
            return $next($request);
        }

        // Nếu không phải admin, chuyển hướng về trang khác (ví dụ: trang home)
        return redirect('/home');
    }
}

