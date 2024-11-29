<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Teacher
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

        $userRole = Auth::user()->role;

        if($userRole == 'admin'){
            return redirect()->route('admin.dashboard');
        }elseif($userRole == 'teacher'){
            return $next($request);

        }elseif($userRole == 'student'){
            return redirect()->route('students.dashboard');
        }
        return $next($request);
    }
}
