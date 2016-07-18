<?php

namespace App\Http\Middleware;

use Closure;

class cekAdmin
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
        if (!\Auth::check()) {
            return redirect()->back();
        }else{
            if($request->user()->isAnAdministrator())
            {
                return $next($request);
            }
            return response("<script>alert('khusus Admin');window.location = '/bismillah';</script>");
        }
    }
}
