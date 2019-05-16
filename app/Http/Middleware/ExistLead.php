<?php

namespace App\Http\Middleware;

use App\Models\Lead;
use Closure;
use Illuminate\Http\Request;

class ExistLead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next)
    {
        $lead = Lead::find($request->route('lead'));
        if (!$lead) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
