<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user()) {
            if($request->user()->user_type == 'admin'){
                return $next($request);
            }
            return redirect('/');
        }
        return redirect()->route('admin.login');

    }
}
