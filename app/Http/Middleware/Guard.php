<?php

namespace App\Http\Middleware;
use App\Student;
use App\Admin;

use Closure;

class Guard
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
        $value=$request->session()->get('email');
        if(empty($value))
        {
            return redirect('/');
        }
        return $next($request);
    }
}
