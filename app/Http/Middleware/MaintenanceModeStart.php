<?php

namespace App\Http\Middleware;

use App\Models\Maintenance;
use Closure;
use Illuminate\Http\Request;

class MaintenanceModeStart
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
            if (Maintenance::find(1)->status == "active") {
                return redirect()->route("maintenance-page");
            }
        }
        return $next($request);
    }
}
