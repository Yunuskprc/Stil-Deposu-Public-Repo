<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;
use App\Models\JsonModel\ProductModel;
use Illuminate\Support\Facades\Log;
use App\Helpers\CustomHelpers;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\UserInfo;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Storage;

class SellerImageController extends Controller
{
    public function addCardImage(Request $request){
        try {
            if ($request->hasFile('cardImage')) {
                $file = $request->file('cardImage');
                $brands = CustomHelpers::getBrandForAuthenticatedUser();
                $filename =  $brands->brands_name. '_CardImage_' .  time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('brandsImages', $filename, 's3');

               $brands->cardImageURI = $filename;
               $brands->save();

                return response()->json(['success' => true, 'message' => 'Marka Kart fotoğrafı başarıyla eklendi!.']);
            }

            return response()->json(['success' => false, 'message' => 'Resim dosyası bulunamadı!.']);
        } catch (\Exception $e) {
            Log::error('Card image upload failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Fotoğraf eklenirken bir sorun oluştu!.']);
        }
    }

    public function addLogo(Request $request){
        try {
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $brands = CustomHelpers::getBrandForAuthenticatedUser();
                $filename =  $brands->brands_name . '_Logo_' .  time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('brandsImages', $filename, 's3');

               $brands->logoURI = $filename;
               $brands->save();

                return response()->json(['success' => true, 'message' => 'Marka Kart fotoğrafı başarıyla eklendi!.']);
            }

            return response()->json(['success' => false, 'message' => 'Resim dosyası bulunamadı!.']);
        } catch (\Exception $e) {
            Log::error('Card image upload failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Fotoğraf eklenirken bir sorun oluştu!.']);
        }
    }


    public function deleteCardImage(Request $request){
        try {
            $brands = CustomHelpers::getBrandForAuthenticatedUser();
            Log::info($brands->cardImageURI);
            $cardImagePath = '/brandsImages/'.$brands->cardImageURI;
            Log::info($cardImagePath);
            if (Storage::disk('s3')->exists($cardImagePath)) {
                Storage::disk('s3')->delete($cardImagePath);
                $brands->cardImageURI = null;
                $brands->save();
                return response()->json(['success' => true, 'message' => 'Marka Kart fotoğrafı başarıyla silindi!.']);
            }

            return response()->json(['success' => false, 'message' => 'Resim dosyası bulunamadı!.']);
        } catch (\Exception $e) {
            Log::error('Card image deletion failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Fotoğraf silinirken bir sorun oluştu!.']);
        }
    }


    public function deleteLogo(Request $request){
    try {
        $brands = CustomHelpers::getBrandForAuthenticatedUser();
        $cardImagePath = '/brandsImages/'.$brands->logoURI;

        if (Storage::disk('s3')->exists($cardImagePath)) {
            Storage::disk('s3')->delete($cardImagePath);

            $brands->logoURI = null;
            $brands->save();

            return response()->json(['success' => true, 'message' => 'Logo fotoğrafı başarıyla silindi!.']);
        }

        return response()->json(['success' => false, 'message' => 'Resim dosyası bulunamadı!.']);
    } catch (\Exception $e) {
        Log::error('Logo image deletion failed: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Fotoğraf silinirken bir sorun oluştu!.']);
    }
}

}