<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $user = Auth::user();
        $position = $user->position;

        if($position != 0){

            $message = $position ? 'Bạn không có quyền truy cập trang này!' : '';

            return redirect()->route('admin.dashboard.index')->with('error', $message);
        }
        
        return $next($request);
    }
}
