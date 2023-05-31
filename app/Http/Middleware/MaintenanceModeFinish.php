<?php

namespace App\Http\Middleware;

use App\Models\Maintenance;
use Closure;
use Illuminate\Http\Request;

class MaintenanceModeFinish
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
        if (Maintenance::find(1)) {
            if (Maintenance::find(1)->status == "passive") {
                return redirect()->route("home");
            }
        }
        return $next($request);
    }
}
