<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Yonetici
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
        //yonetici olup olmadıgını kontrol ettirelim
        if(auth()->user()->yonetici_mi == 1){
            return $next($request);
        }
        else{
            return redirect()->route('anasayfa');
        }


    }
}
