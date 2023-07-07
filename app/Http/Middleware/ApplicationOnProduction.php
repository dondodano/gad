<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplicationOnProduction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = storage_path('framework/') .'production';
        if(file_exists( $path))
        {
            $content = file_get_contents($path);
            if(filter_var($content, FILTER_VALIDATE_BOOLEAN) == true)
            {
                abort('404');
            }

        }
        return $next($request);
    }
}
