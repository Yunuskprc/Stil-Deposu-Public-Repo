<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\CustomHelpers;
use Illuminate\Support\Facades\Log;
use App\Models\VerifyCode;
use App\Models\UserInfo;
use Carbon\Carbon;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class MailController extends Controller
{
    public function generateCode(Request $request){
        try {
            $generateCode = mt_rand(100000, 999999);
            $user = CustomHelpers::getUser();

            // eski code 'u silecek.
            VerifyCode::where(['user_id' => $user->user_id])->delete();


            $verify_code = VerifyCode::create([
                'user_id' => $user->user_id,
                'verify_code' => $generateCode,
                'isComp' => false,
                'isExp' => false,
                'expires_at' => now()->addMinute(3),
            ]);

            try {
                Mail::to($user->mail_adress)->send(new VerifyEmail($generateCode,$user));
            } catch (Exception $e) {
                Log::error('Error Mail Sending: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Doğrulama kodu gönderilemedi.',
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Doğrulama kodu gönderildi.'
            ], 200);

        } catch (Exception $e) {
            Log::error('Error generating verification code: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Doğrulama kodu oluşturulamadı.',
            ], 500);
        }
    }


public function checkCode(Request $request) {
    $verify_code = $request->verificationCode;
    try {
        $user = CustomHelpers::getUser();
        $user_verify = VerifyCode::where(['user_id' => $user->user_id])->firstOrFail(); // İlk olarak model bulunamazsa hata fırlatır

        if ($user_verify->isComp != 0) {
            return response()->json([
                'success' => false,
                'message' => 'Doğrulama kodu zaten tamamlanmış!.',
            ], 500);
        }

        if ($user_verify->expires_at <= Carbon::now()) {
            return response()->json([
                'success' => false,
                'message' => 'Doğrulama kodunun süresi dolmuş.!',
            ], 500);
        }

        if ($user_verify->verify_code == $verify_code) {
            $userInfo = UserInfo::where(['user_id' => $user->user_id])->firstOrFail();
            $userInfo->mail_verify = 1;
            $userInfo->save();
            $user_verify->delete();

            return response()->json([
                'success' => true,
                'message' => 'Doğrulama başarıyla gerçekleşti.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Doğrulama kodunun yanlış!.',
            ], 500);
        }
    } catch (\Exception $e) {
        Log::error('Error:: ' . $e);
        return response()->json([
            'success' => false,
            'message' => 'Bir hata oluştu.',
        ], 500);
    }
}




    public function showTestEmailTemplate()
    {
        $user = (object) [
            'name' => 'Test User',
            'email' => 'testuser@example.com'
        ];
        $emailVerificationCode = '123456';

        return view('emails.verify', compact('user', 'emailVerificationCode'));
    }
}