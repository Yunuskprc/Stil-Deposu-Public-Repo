<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\ProductComment;
use App\Models\Product;
use App\Models\Basket;
use App\Models\FollowProduct;
use App\Models\UserInfo;
use App\Models\User;
use App\Models\WaitingSoldProduct;
use App\Models\JsonModel\BasketProductModal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\YourOrderHasBeenReceived;
use App\Mail\SellerNewOrder;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\CustomHelpers;

class UserPPDController extends Controller
{


    public function addComment(Request $request) {
        $user = CustomHelpers::getUser();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Kullanıcı bilgileri bulunamadı.'
            ], 401); // Unauthorized (401)
        }

        if (empty($request->comment)) {
            return response()->json([
                'success' => false,
                'message' => 'Yorum alanı boş bırakılmamalı!.'
            ], 400); // Bad Request (400)
        }

        $hasCommented = ProductComment::where('user_id', $user->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($hasCommented) {
            return response()->json([
                'success' => false,
                'message' => 'Daha önce zaten bu ürüne yorum yapmışsınız!.'
            ], 400); // Bad Request (400)
        }

        try {
            $productComment = new ProductComment();
            $productComment->product_id = $request->product_id;
            $productComment->user_id = $user->user_id;
            $productComment->comment = $request->comment;
            $productComment->commentRate = $request->commentRate;

            $productComment->save();

            return response()->json([
                'success' => true,
                'message' => 'Yorumunuz yapıldı.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Add comment failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Yorum yapılamadı!'
            ], 500);
        }
    }





    public function addBasketProduct(Request $request)
    {
        $user = CustomHelpers::getUser();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Lütfen Giriş Yapın'
            ], 404);
        }

        try {
            $product_id = $request->product_id;
            $basket = Basket::where('user_id', $user->user_id)->first();
            if (!$basket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sepet bulunamadı.'
                ], 404);
            }

            $products = $basket->products;
            if (!is_array($products)) {
                $products = [];
            }

            $productFound = false;
            foreach ($products as &$product) {
                if ($product['product_id'] == $product_id) {
                    $product['count'] += 1;
                    $productFound = true;
                    break;
                }
            }

            if (!$productFound) {
                $products[] = [
                    'product_id' => $product_id,
                    'count' => 1,
                    'is_active' => 1
                ];
            }

            $basket->products = $products;
            $basket->updated_at = now();
            $basket->save();

            return response()->json([
                'success' => true,
                'message' => 'Ürün sepete başarıyla eklendi.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Add basket product failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ürün sepete eklenemedi!'
            ], 500);
        }
    }


    // add and delete
    public function addFollowProduct(Request $request){
        $user = CustomHelpers::getUser();
        if(!$user){
            return response()->json([
                    'success' => false,
                    'message' => 'Kullanıcı bilgileri bulunamadı.'
            ], 404);
        }

        try{
            $hasFollowed = FollowProduct::where('user_id',$user->user_id)
                ->where('product_id',$request->product_id)->first();

            if(!$hasFollowed){
                $followed = new FollowProduct();
                $followed->product_id = $request->product_id;
                $followed->user_id = $user->user_id;
                $followed->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Ürün favorilere eklendi.'
                ], 200);

            }else{
                $hasFollowed->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Ürün favorilerden çıkarıldı.'
                ], 200);

            }

        }catch(\Exception $e){
            Log::error('Add follow product failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ürün favorilere eklenemedi!'
            ], 500);
        }

    }


    public function deleteComment(Request $request){
         try {
            $comment_id = $request->input('index');
            $comment = ProductComment::where('comment_id',$comment_id);
            $comment->delete();

            return response()->json([
                'success' => true,
                'message' => 'Yorum  silindi.'
            ], 200);
        } catch (\Exception $e) {
            Log::error('Delete failed comment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Yorum silinirken bir hata oluştu.'
            ], 500);
        }
    }



    //basket contoroller
    public function addOrLessProductOnBasket(Request $request){
        try{
            $typeController = $request->type;
            $product_id = $request->product_id;

            $user = CustomHelpers::getUser();
            if(!$user){
                return response()->json([
                    'success' => false,
                    'message' => 'Lütfen Giriş Yapın.'
                ], 401);
            }

            $basket = Basket::where('user_id',$user->user_id)->first();
            $products = $basket->products;
            $message = "";

            foreach($products as $key => $product){
                if($product['product_id'] == $product_id){
                    $count = $product['count'];
                    if($typeController == "less"){
                        $product['count'] = $count -1;
                        $message = "1 Adet Ürün sepetinizden çıkarıldı!";
                    }else if($typeController == "add"){
                        $product['count'] = $count +1;
                        $message = "1 Adet Ürün sepetinize eklendi!";
                    }
                    $products[$key] = $product;
                    break;
                }
            }

            $basket->products = $products;
            $basket->save();

            return response()->json([
                'success' => true,
                'message' => $message
            ], 200);


        }catch (\Exception $e) {
            Log::error('Delete failed comment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu.'
            ], 500);
        }
    }


    public function deleteProductOnBasket(Request $request){
        try{
            $product_id = $request->product_id;
            $user = CustomHelpers::getUser();

            if(!$user){
                return response()->json([
                    'success' => false,
                    'message' => 'Lütfen Giriş Yapın.'
                ], 401);
            }

            $basket = Basket::where('user_id',$user->user_id)->first();
            $products = $basket->products;

            $filteredProducts = array_filter($products, function($product) use ($product_id) {
                return $product['product_id'] != $product_id;
            });

            $filteredProducts = array_values($filteredProducts);

            $basket->products = $filteredProducts;
            $basket->save();

            return response()->json([
                'success' => true,
                'message' => "Ürün sepetinizden çıkarıldı"
            ], 200);

        }catch (\Exception $e) {
            Log::error('Delete failed comment: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ürün sepetinizden çıkarılırken bir hata oluştu.'
            ], 500);
        }
    }


    public function changeActiveProductOnBasket(Request $request){
        try{
            $product_id = $request->product_id;
            $type = $request->type;
            $user = CustomHelpers::getUser();

            if(!$user){
                return response()->json([
                    'success' => false,
                    'message' => 'Lütfen Giriş Yapın.'
                ], 401);
            }

            $basket = Basket::where('user_id',$user->user_id)->first();
            $products = $basket->products;
            $message = "";
            foreach($products as $key => $product){
                if($product['product_id'] == $product_id){

                    if($type == "acitve"){
                        $product['is_active'] = 0;
                        $message = "Ürün artık aktif değil çıkarıldı!";
                    }else if($type == "un_active"){
                        $product['is_active'] = 1;
                        $message = "Ürün tekrardan aktif eklendi!";
                    }
                    $products[$key] = $product;
                    break;
                }
            }

            $basket->products = $products;
            $basket->save();

            return response()->json([
                'success' => true,
                'message' => $message
            ], 200);

        }catch(\Exception $e) {
            Log::error('Unacitve failed basket product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ürün hala aktif! Bir hata oluştu.'
            ], 500);
        }

    }


    public function complateBasket(Request $request){
        try {
            $user = CustomHelpers::getUser();
            $user_info = UserInfo::where('user_id', $user->user_id)->first();

            if ($user_info->mail_verify == 1) {
                $adress = json_decode($request->address,true);
                $card = json_decode($request->cards,true);
                $basket = Basket::where('user_id', $user->user_id)->first();

                if ($basket) {
                    $products = BasketProductModal::retrunData($basket->products);

                    $productsByBrand = collect($products)->groupBy(function($product) {
                        return $product['product']['brand_id'];
                    });
                }

                $activeProductsByBrand = $productsByBrand->map(function ($products) {
                    return collect($products)->filter(function ($product) {
                        return $product['is_active'] == 1;
                    })->values();
                });

                $products = json_decode($activeProductsByBrand, true);

                foreach ($products as $key => $brandProduct) {
                    $productsData = [];

                    foreach ($brandProduct as $product) {
                        $updateStock = Product::where('product_id', $product['product_id'])->first();
                        $productDetail = $updateStock->product_detail;
                        $productDetail['stock'] = $productDetail['stock'] - $product['count'];
                        $updateStock->product_detail = $productDetail;

                        $updateStock->save();

                        $productsData[] = [
                            'count' => $product['count'],
                            'product_id' => $product['product_id'],
                        ];
                    }

                    $waitSoldProducts = new WaitingSoldProduct();
                    $waitSoldProducts->user_id = $user->user_id;
                    $waitSoldProducts->brand_id = $key;
                    $waitSoldProducts->order_debit_card = $card;
                    $waitSoldProducts->order_address = $adress;
                    $waitSoldProducts->products = $productsData;

                    $waitSoldProducts->save();

                    $brand = Brand::where('brand_id', $key)->first();
                    $brandUser = User::where('user_id', $brand->user_id)->first();
                    Mail::to($brandUser->mail_adress)->send(new SellerNewOrder($brandUser));
                }

                Mail::to($user->mail_adress)->send(new YourOrderHasBeenReceived($products, $request->address, $request->cards, $user));
                $basket->products = [];
                $basket->save();

                return response()->json([
                    'success' => true,
                    'message' => "Siparişleriniz Onaylanmıştır."
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Hesabınızı doğrulamadan sipariş veremezsiniz!.'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Unacitve failed basket product: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Sipariş Tamamlanamadı! Bir hata oluştu.'
            ], 500);
        }
    }


}