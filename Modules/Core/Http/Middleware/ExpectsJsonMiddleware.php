<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExpectsJsonMiddleware
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
        if (!request()->expectsJson()) {
            return response_json(false, 'InvalidHeadersException', "Header 'Accept' harus bernilai 'application/json'.");
        }
        return $next($request);
    }
}
