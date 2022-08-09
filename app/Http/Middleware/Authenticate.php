<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{

    protected $guards;

    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::check())
        {
            return $next($request);   
        }
        else
        {
            return redirect()->route('admin.login');
        }
        // $this->guards = $guards;

        // return parent::handle($request, $next, ...$guards);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (Auth::user())
    //     {
            
    //     }
    //     if (!$request->expectsJson()) {
    //         if (Arr::first($this->guards) === 'admin') {
    //             return route('admin.login');
    //         }
    //         return route('login');
    //     }
    // }
}
