<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $token = Session::get('jwt_token');
        if(!$token){
           return redirect()->route('showLogin')->with('error', 'Lütfen Giriş Yapın');
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
            if ($user->role === 'user') {
                return $next($request);
            } else {
                return response()->json(['error' => 'Yetkiniz yok.'], 403);
            }
        }catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return redirect()->route('showLogin')->with('error', 'Tekrar Giriş Yapın');
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return redirect()->route('showLogin')->with('error', 'Lütfen Giriş Yapın');
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return redirect()->route('showLogin')->with('error', 'Lütfen Giriş Yapın');
        }
    }
}