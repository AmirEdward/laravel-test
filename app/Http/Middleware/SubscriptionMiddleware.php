<?php

namespace App\Http\Middleware;

use Closure;

class SubscriptionMiddleware
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
        if($request->user() && $request->user()->user_type != 'admin' && ! $request->user()->subscribed('subscription')){
            return redirect()->route('billing');
        }
        return $next($request);
    }
}
