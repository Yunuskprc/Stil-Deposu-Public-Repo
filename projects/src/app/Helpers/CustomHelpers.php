<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Brand;

class CustomHelpers
{
    public static function getBrandForAuthenticatedUser()
    {
        $token = Session::get('jwt_token');
        if (!$token) {
            // yönlendirme yapılcak;
            return 'asdjnşajsjldşsak';
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
            $userId = $user->user_id;
            $brand = Brand::where('user_id', $userId)->first();

            return $brand;
        } catch (\Exception $e) {
            return $e;
        }
    }


    public static function getUser(){
        $token = Session::get('jwt_token');
        if (!$token) {
            return null;
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
            return $user;
        } catch (\Exception $e) {
            return null;
        }
    }

}