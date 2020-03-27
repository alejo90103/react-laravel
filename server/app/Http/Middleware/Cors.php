<?php
# @Author: Codeals
# @Date:   04-08-2019
# @Email:  ian@codeals.es
# @Last modified by:   alejandro
# @Last modified time: 2019-11-26T00:07:47+01:00
# @Copyright: Codeals

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $domains = ['http://localhost:8080'];

        if (isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];
            // if (in_array($origin, $domains)) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('access-control-allow-methods:GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS');
                header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
            // }
        }

        return $next($request);
    }
}
