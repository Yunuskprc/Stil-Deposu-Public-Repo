<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;
use App\Models\JsonModel\ProductModel;
use App\Models\WaitingSoldProduct;
use App\Models\SoldProduct;
use App\Models\Product;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShippedNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Helpers\CustomHelpers;
use Carbon\Carbon;


class SellerPPDController extends Controller
{
    public function addProc(Request $request)
    {

        try {
            $files = $request->file('images');
            $fileNames = [];
            $brand = CustomHelpers::getBrandForAuthenticatedUser();
            foreach ($files as $file) {
                $currentDateTime = Carbon::now()->format('YmdHis'); // Format ayarını yapın
                $newFileName = $brand->brands_name . '_' . $currentDateTime . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('brandsImages', $newFileName, 's3');
                $fileNames[] = $newFileName;
            }


            $insertData = ProductModel::createProductJson($request,$fileNames);

            $product = Product::create([
                'category_id' => $insertData['category_id'],
                'brand_id' => $insertData['brand_id'],
                'category_name' => $insertData['category_name'],
                'brand_name' => $insertData['brand_name'],
                'product_detail' => $insertData['product_detail']
            ]);

            return response()->json(['success' => true, 'product' => $product]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function updateProc(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        try {
            $currentProductDetail = $product->product_detail;
            $data = $request->except('product_id');
            $fileNames = $currentProductDetail['file_names'] ?? [];
            $updatedProductDetail = array_merge($data, ['file_names' => $fileNames]);

            $product->product_detail = $updatedProductDetail;
            $product->save();

            return response()->json(['success' => true, 'message' => 'Product updated successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the product.'], 500);
        }
    }



    public function activatedProc(Request $request){
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        try{
            $product->active_sales = 1;
            $product->save();
            return response()->json(['success' => true, 'message' => 'Product active successfully.'], 200);
        }catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while active the product.'], 500);
        }
    }


    public function deletedProc(Request $request){
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.'], 404);
        }

        try{
            $product->active_sales = 0;
            $product->save();
            return response()->json(['success' => true, 'message' => 'Product delete successfully.'], 200);
        }catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while delete the product.'], 500);
        }
    }


    public function updateProfileInfo(Request $request){

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'surname' => 'required|string|max:255',
                'email' => 'required|email',
                'phone_prefix' => 'required|string|max:5',
                'phone_number' => 'required|string|max:20',
                'day' => 'required|integer|between:1,31',
                'month' => 'required|integer|between:1,12',
                'year' => 'required|integer|min:1940|max:2010',
            ]);

            $user = CustomHelpers::getUser();
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->mail_adress = $request->email;
            $user->phone_number = $request->phone_number;
            $user->save();

            $formattedDate = null;
            if ($request->input('day') && $request->input('month') && $request->input('year')) {
                try {
                    $formattedDate = Carbon::create($request->input('year'), $request->input('month'), $request->input('day'))->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    return response()->json(['success' => false, 'message' => 'Geçersiz tarih formatı.']);
                }
            }

            $userinfo = UserInfo::where(['user_id' => $user->user_id])->first();
            $userinfo->birth_date = $formattedDate;
            $userinfo->save();

            return response()->json(['success' => true, 'message' => 'Bilgiler güncellendi.'], 200);

        } catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the profile information.'], 500);
        }
    }


    public function updatePassword(Request $request)
    {
        try {
            if ($request->newPassword != $request->newPasswordRep) {
                return response()->json(['success' => false, 'message' => 'Yeni girilen şifreler uyuşmuyor.'], 400);
            }

            if (Str::length($request->newPassword) < 6) {
                return response()->json(['success' => false, 'message' => 'Şifre en az 6 karakterli olmalıdır.'], 422);
            }

            $user = CustomHelpers::getUser();

            if (!Hash::check($request->oldPassword, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Girilen eski şifre uyuşmuyor.'], 400);
            }

            $user->password = Hash::make($request->newPassword);
            $user->save();

            return response()->json(['success' => true, 'message' => 'Şifre güncellendi'], 200);
        } catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the profile information.'], 500);
        }
    }


    public function addAdress(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'addressDetails' => 'required|string|max:1000',
            'phoneNumber' => 'required|string|max:10',
            'addressName' => 'required|string|max:255',
        ]);

        try {
            $newAddress = [
                'name' => $request['name'],
                'surname' => $request['surname'],
                'city' => $request['city'],
                'street' => $request['street'],
                'addressDetails' => $request['addressDetails'],
                'phoneNumber' => $request['phoneNumber'],
                'addressName' => $request['addressName']
            ];

            $user = CustomHelpers::getUser();
            $user_info = UserInfo::where('user_id', $user->user_id)->first();

            if (!$user_info) {
                return response()->json([
                    'success' => false,
                    'message' => 'User information not found.'
                ], 404);
            }

            if (is_string($user_info->adress)) {
                $existingAddresses = json_decode($user_info->adress, true);
                if (!is_array($existingAddresses)) {
                    $existingAddresses = [];
                }
            } else {
                $existingAddresses = $user_info->adress ?? [];
            }

            $existingAddresses[] = $newAddress;

            $user_info->adress = json_encode($existingAddresses);
            $user_info->save();

            return response()->json([
                'success' => true,
                'message' => 'Adres başarıyla eklendi'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Update failed Address: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Adres eklenirken bir hata oluştu.'
            ], 500);
        }
    }


    public function deleteAdress(Request $request)
    {
        try {
            $index = $request->input('index');

            if (!isset($index)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Adres ID bulunamadı.'
                ], 400);
            }


            $user = CustomHelpers::getUser();
            $userInfo = UserInfo::where('user_id', $user->user_id)->first();

            if (!$userInfo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kullanıcı bilgileri bulunamadı.'
                ], 404);
            }

            if (is_string($userInfo->adress)) {
                $addresses = json_decode($userInfo->adress, true);
            } else {
                $addresses = $userInfo->adress;
            }

            if (!isset($addresses[$index])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Belirtilen indeks mevcut değil.'
                ], 400);
            }

            unset($addresses[$index]);
            $addresses = array_values($addresses);

            $userInfo->adress = json_encode($addresses);
            $userInfo->save();

            return response()->json([
                'success' => true,
                'message' => 'Adres başarıyla silindi.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Update failed Address: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Adres silinirken bir hata oluştu.'
            ], 500);
        }
    }


    public function addDebitCard(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cartName' => 'required|string|max:255|min:1',
                'cartNumber' => 'required|string|max:16|min:16',
                'sktMonth' => 'required|string|max:2',
                'sktYear' => 'required|string|max:2',
                'cvv' => 'required|string|max:3|min:3',
                'cartOwnerName' => 'required|string|max:255',
            ]);

            $imgUrl = "";
            switch($request->cartType){
                case 1:
                    $imgUrl = '/images/banksLogo/ziraatbankası50px.png';
                    break;
                case 2:
                    $imgUrl = '/images/banksLogo/vakifbank50px.png';
                    break;
                case 3:
                    $imgUrl = '/images/banksLogo/işbankası50px.png';
                    break;
                case 4:
                    $imgUrl = '/images/banksLogo/halkbank50px.png';
                    break;
                case 5:
                    $imgUrl = '/images/banksLogo/garanti50px.png';
                    break;
                case 6:
                    $imgUrl = '/images/banksLogo/yapıkredi50px.png';
                    break;
                case 7:
                    $imgUrl = '/images/banksLogo/akbank50px.png';
                    break;
                case 8:
                    $imgUrl = '/images/banksLogo/qnb50px.png';
                    break;
                case 10:
                    $imgUrl = "";
                    break;
            }

            $newCards = [
                'cart_name' => $request->cartName,
                'cart_number' => $request->cartNumber,
                'cart_skt_month' => $request->sktMonth,
                'cart_skt_year' => $request->sktYear,
                'cart_cvv' => $request->cvv,
                'cart_owner_name' => $request->cartOwnerName,
                'cart_type' => $imgUrl
            ];

            $user = CustomHelpers::getUser();
            $user_info = UserInfo::where(['user_id' => $user->user_id])->first();
            if (!$user_info) {
                return response()->json([
                    'success' => false,
                    'message' => 'User information not found.'
                ], 404);
            }

            if (is_string($user_info->cards)) {
                $existingCards = json_decode($user_info->cards, true);
                if (!is_array($existingCards)) {
                    $existingCards = [];
                }
            } else {
                $existingCards = $user_info->cards ?? [];
            }

            $existingCards[] = $newCards;

            $user_info->cards = json_encode($existingCards);
            $user_info->save();

            return response()->json([
                'success' => true,
                'message' => 'Kart başarıyla eklendi'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Add Debit Card Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Kart eklenirken bir hata oluştu.'
            ], 500);
        }
    }


    public function deleteDebitCard(Request $request){
        try {
            $index = $request->input('index');
            if (!isset($index)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cart ID bulunamadı.'
                    ], 400);
            }
            $user = CustomHelpers::getUser();
            $userInfo = UserInfo::where('user_id', $user->user_id)->first();
            if (!$userInfo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kullanıcı bilgileri bulunamadı.'
                ], 404);
            }

            if (is_string($userInfo->cards)) {
                $cards = json_decode($userInfo->cards, true);
            } else {
                $cards = $userInfo->cards;
            }

            if (!isset($cards[$index])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Belirtilen indeks mevcut değil.'
                ], 400);
            }

            unset($cards[$index]);
            $cards = array_values($cards);
            $userInfo->cards = json_encode($cards);
            $userInfo->save();

            return response()->json([
                'success' => true,
                'message' => 'Kart başarıyla silindi.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Update failed Address: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Kart silinirken bir hata oluştu.'
            ], 500);
        }
    }



    public function waitingSalesComplate(Request $request){
        try{
            $waiting_id = $request->waiting_id;

            $waitingSales = WaitingSoldProduct::where('waiting_id',$waiting_id)->first();

            // sold products table add data
            $newSoldProduct = new SoldProduct();
            $newSoldProduct->user_id = $waitingSales->user_id;
            $newSoldProduct->brand_id = $waitingSales->brand_id;
            $newSoldProduct->products = $waitingSales->products;
            $newSoldProduct->order_address = $waitingSales->order_address;
            $newSoldProduct->order_debit_card = $waitingSales->order_debit_card;
            $newSoldProduct->save();

            //send mail user information
            $user = User::where('user_id',$waitingSales->user_id)->first();
            $products = [];
            foreach($waitingSales->products as $productDetail){
                $data = Product::where('product_id',$productDetail['product_id'])->first()->toArray();
                $data['count'] = $productDetail['count'];
                $products[] = $data;
            }

            Mail::to($user->mail_adress)->send(new OrderShippedNotification($products, $waitingSales->order_address, $user));

            //waiting sales table delete data
            $waitingSales->delete();
            return response()->json([
                    'success' => true,
                    'message' => "Sipariş Kargoya Verilmiştir."
                ], 200);
        }catch (\Exception $e) {
            Log::error('Unacitve failed basket product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sipariş Tamamlanamadı! Bir hata oluştu.'
            ], 500);
        }
    }


    public function getSoldSalesDetail(Request $request){
        try{
            $sold_product_id = $request->sold_product_id;
            $soldSales = SoldProduct::where('sold_product_id',$sold_product_id)->first();
            $returnData = [];

            foreach($soldSales['products'] as $product){
                $productDetail = Product::where('product_id',$product['product_id'])->first()->toArray();
                $productDetail['count'] = $product['count'];
                $returnData[] = $productDetail;
            }

            return response()->json([
                    'success' => true,
                    'returnData' => $returnData,
                    'message' => "Sipariş Bilgileri."
                ], 200);
        }catch (\Exception $e) {
            Log::error('Unacitve failed basket product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sipariş bulunamadı! Bir hata oluştu.'
            ], 500);
        }
    }

}