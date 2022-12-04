<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('members')->user() != null) {
            return $next($request);
        }
        if (request()->ajax()) {
            return response()->json(["error" => "You have not logged in yet!"]);
        }
        session(['url.intended' => $request->url()]);
        return redirect('login');
    }
}
