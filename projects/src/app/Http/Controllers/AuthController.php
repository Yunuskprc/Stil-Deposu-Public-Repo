<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Brand;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;




class AuthController extends Controller
{
    public function showLogin(Request $request){
        return view('auth.login');
    }

    public function showRegister(){
        return view('auth.register');
    }

    public function register(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'mail_adress' => 'required|email',
            'password' => 'required|string|min:6',
            'phone_number' => ['required', 'string', 'regex:/^\d{3}\d{3}\d{4}$/'],
            'role' => 'required|string|in:user,seller',
            'brands_name' => 'nullable|string|max:255|required_if:role,seller', // Satıcı ismi, sadece satıcı rolü seçildiğinde zorunlu
        ]);


        if (!$this->checkPassword($request))
            return redirect()->back()->withInput()->withErrors(['password' => 'Şifreler eşleşmiyor.']);

        if ($this->checkEmailExist($request))
            return redirect()->back()->withInput()->withErrors(['mail_adress' => 'Bu mail adresi zaten kullanılıyor.']);

        if ($this->phoneNumberExist($request))
            return redirect()->back()->withInput()->withErrors(['phone_number'=> 'Bu telefon numarası zaten kullanılıyor']);

        if ($this->createUser($request))
            return redirect()->route('showLogin')->with('success', 'Kayıt başarılı! Şimdi giriş yapabilirsiniz.');
        else
            return redirect()->back()->withInput()->withErrors(['registerUnSucces'=>'Kayıt olurken bir sorun oluştu tekrar deneyin']);

    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('mail_adress', $request->email)->first();
        if (!$user) {
            return redirect()->route('showLogin')->with('error', 'Kullanıcı bulunamadı. Tekrar deneyin!');
        }

        $credentials = $request->only('email', 'password');
        $credentials['mail_adress'] = $credentials['email'];
        unset($credentials['email']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return redirect()->route('showLogin')->with('error', 'Giriş Başarısız. Tekrar deneyin!');
        }

        $userRole = $user->role;
        $token = JWTAuth::claims(['role' => $userRole])->attempt($credentials);

        if ($userRole == 'seller') {
            session(['jwt_token' => $token]);
            return redirect()->route('seller.show.dashboard');
        } elseif ($userRole == 'user') {
            session(['jwt_token' => $token]);
            return redirect()->route('user.show.home');
        }

        session(['jwt_token' => $token]);
        return redirect()->route('user.show.home');

    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $this->me()
        ]);
    }

    public function logOut(Request $request)
    {
        $token = Session::get('jwt_token');
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Bir hata oluştu'], 500);
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json(['success' => true, 'message' => 'İyi günler ' . $user->name], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Bir hata oluştu'], 500);
        }
    }












    // custom validation methods here
    public function checkPassword(Request $request)
    {
       return $request['password'] == $request['password_rep'];
    }

    public function checkEmailExist(Request $request)
    {
        return User::where(['mail_adress' => $request['mail_adress']])->exists();
    }


    public function phoneNumberExist(Request $request)
    {
        return User::where('phone_number', $request['phone_number'])->exists();
    }

    public function createUser($request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->mail_adress = $request->mail_adress;
            $user->phone_number = $request->phone_number;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();


            if ($request['role'] == 'seller') {
                $brands = new Brand();
                $brands->user_id = $user->user_id;
                $brands->brands_name = $request->brands_name;
                //dd([$brands,$request->brands_name, $user->user_id]);
                $brands->save();
            }

            $userProfile = new UserInfo();
            $userProfile->user_id = $user->user_id; // Kullanıcıya ait ID'yi ilişki içinde belirtiyoruz
            $userProfile->save();

            if ($request['role'] == 'user') {
                $basket = new Basket();
                $basket->user_id = $user->user_id;
                $basket->products = [];
                $basket->save();
            }

            return true;
        }catch (\Exception $e) {
            \Log::error('Kullanıcı oluşturma işlemi başarısız oldu: ' . $e->getMessage());
            return false;
        }
    }


}