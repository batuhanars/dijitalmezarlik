<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CountVisitor
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
        $ip = hash("sha512", $request->ip());
        if (Visitor::whereDay("date", "=", today())->where('ip', $ip)->count() < 1) {
            Visitor::create([
                "ip" => $ip
            ]);
        }
        return $next($request);
    }
}
