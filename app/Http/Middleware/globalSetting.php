<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class globalSetting
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
        $settings = Setting::whereIn('key', ['reg_approve', 'sned_email', 'signup_email','member_expire_notify_date','book_rent_duration'])->get()->pluck('value', 'key');
        view()->share('settings', $settings);
        return $next($request);
    }
}
