<?php
# @Author: Codeals
# @Date:   19-06-2019
# @Email:  ian@codeals.es
# @Last modified by:   Codeals
# @Last modified time: 23-11-2019
# @Copyright: Codeals

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if (auth()->check() && (auth()->user()->admin == 1))
            return $next($request);

        return redirect('login');
    }
}
