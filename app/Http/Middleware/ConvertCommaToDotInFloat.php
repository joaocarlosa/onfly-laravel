<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ConvertCommaToDotInFloat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();

        array_walk_recursive($input, function (&$item, $key) {
            if (is_string($item) && preg_match('/^\d+(\,\d{1,2})?$/', $item)) {
                $item = str_replace(',', '.', $item);
            }
        });

        $request->merge($input);

        return $next($request);
    }

}
