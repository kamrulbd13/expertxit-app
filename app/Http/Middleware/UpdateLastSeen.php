<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UpdateLastSeen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            $user->last_seen_at = Carbon::now();
            $user->save();
        }

        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            $customer->last_seen_at = Carbon::now();
            $customer->save();
        }

        return $next($request);
    }
}
