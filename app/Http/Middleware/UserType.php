<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserType
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
        if(auth()->user()->utype == 'tekshiruvchi')
        {
            return $next($request);
        }
        if(auth()->user()->utype == 'operator')
        {
            return $next($request);
        }
        if(auth()->user()->utype == 'admin')
        {
            return $next($request);
        }
        if(auth()->user()->utype == 'sotuvchi')
        {
            return $next($request);
        }
        return redirect('/')->with('error','Bunday Tipdagi Foydalanuvchi Mavjud Emas!');
        
    }
}
