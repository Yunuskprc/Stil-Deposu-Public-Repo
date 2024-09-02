<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductComment;
use App\Models\Product;
use App\Models\FollowProduct;
use App\Models\UserInfo;
use App\Models\Basket;
use App\Models\WaitingSoldProduct;
use App\Models\SoldProduct;
use App\Models\JsonModel\BasketProductModal;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;


use App\Helpers\CustomHelpers;

class UserShowController extends Controller
{
    //
    public function index(){
        $brands = Brand::all();
        $brandsAttributes = $brands->map(function ($brand) {
            return $brand->attributesToArray();
        });

        return view('client.index',compact('brandsAttributes'));
    }


    public function getSearchPage(Request $request){
        try{
            $search_key = $request->search_key;
            $user = CustomHelpers::getUser();

            $searchProductName = Product::where('product_detail->proc_name', 'LIKE', '%' . $search_key . '%')->limit(20)->get();
            $searchCategoryName = Category::where('category_name','LIKE','%'.$search_key.'%')->limit(20)->get();
            $searchBrandName = Brand::where('brands_name','LIKE','%'.$search_key.'%')->limit(20)->get();

            if($user){
                foreach ($searchProductName as $product) {
                    $product->isFollowed = FollowProduct::where('user_id', $user->user_id)
                        ->where('product_id', $product->product_id)
                        ->exists();
                }
            }else{
                foreach ($searchProductName as $product) {
                    $product->isFollowed = false;
                }
            }

            return view('client.SearchPage',compact('searchProductName','searchCategoryName','searchBrandName'));
        }catch(\Exception $e){
            return response()->view('errors.500', [], 500);
        }
    }


    public function getProductCart($product_id){

        try{
            $product = Product::where('product_id',$product_id)->first();

            $user = CustomHelpers::getUser();
            if ($user) {
                $product->isFollowed = FollowProduct::where('user_id', $user->user_id)
                    ->where('product_id', $product->product_id)
                    ->exists();
            } else {
                $product->isFollowed = false;
            }

            $imageUrl = Storage::disk('s3')->temporaryUrl('productImages/' . $product->product_detail['file_names'][0], now()->addMinutes(60));
            return view('client.layout.productCard',compact('product','imageUrl'));
        }catch(\Exception $e){
            return response()->view('errors.500', [], 500);
        }
    }




    public function getCategoryPage($category){
        try{

            $categories = Category::where('category_name', $category)->firstOrFail();

            $brand = DB::table('products')
                ->select('brand_id', 'brand_name')
                ->where('active_sales', 1)
                ->where('category_id', $categories->category_id)
                ->distinct()
                ->get();

            $products = Product::where('category_id', $categories->category_id)
                ->where('active_sales', 1)
                ->get();

            $user = CustomHelpers::getUser();
            if ($user) {
                foreach ($products as $product) {
                    $product->isFollowed = FollowProduct::where('user_id', $user->user_id)
                        ->where('product_id', $product->product_id)
                        ->exists();
                }
            } else {
                foreach ($products as $product) {
                    $product->isFollowed = false;
                }
            }

            return view('client.categoryPage', compact('brand', 'categories', 'products'));
        }catch(\Exception $e){
            return response()->view('errors.500', [], 500);
        }
    }


    public function getBrandDetail($brands_name)
    {
        try {
            $brand = Brand::where('brands_name', $brands_name)->firstOrFail();
            $categories = DB::table('products')
                ->select('category_id', 'category_name')
                ->where('active_sales', 1)
                ->where('brand_id', $brand->brand_id)
                ->distinct()
                ->get();

            $products = Product::where('brand_id', $brand->brand_id)
                ->where('active_sales', 1)
                ->get();

            $user = CustomHelpers::getUser();
            if ($user) {
                foreach ($products as $product) {
                    $product->isFollowed = FollowProduct::where('user_id', $user->user_id)
                        ->where('product_id', $product->product_id)
                        ->exists();
                }
            } else {
                foreach ($products as $product) {
                    $product->isFollowed = false;
                }
            }

            return view('client.BrandDetail', compact('brand', 'categories', 'products'));
        } catch (\Exception $e) {
            return response()->view('errors.500', [], 500);
        }
    }



    public function getProductDetail($product_id,Request $request){
       try {
        $product = Product::where('product_id', $product_id)->first();
        $comments = ProductComment::where('product_id', $product_id)->get();

        if (!$product) {
            return response()->view('errors.500', [], 500);
        }

        if (!$comments) {
            return response()->view('errors.500', [], 500);
        }

        $user = CustomHelpers::getUser();
        if ($user) {
            $product->isFollowed = FollowProduct::where('user_id', $user->user_id)
                ->where('product_id', $product->product_id)
                ->exists();
        } else {
            $product->isFollowed = false;
        }

        $commentCount = count($comments);
        $commentDegree = ProductComment::where('product_id', $product_id)->avg('commentRate');
        $commentDegree = round($commentDegree, 1);

        $sameProducts = Product::where('category_id', $product->category_id)->limit(5)->get();
        if ($user) {
            foreach ($sameProducts as $sameProduct) {
                $sameProduct->isFollowed = FollowProduct::where('user_id', $user->user_id)
                    ->where('product_id', $sameProduct->product_id)
                    ->exists();
            }
        } else {
            foreach ($sameProducts as $sameProduct) {
                $sameProduct->isFollowed = false;
            }
        }

        $sameProductsBrand = Product::where('brand_id', $product->brand_id)->limit(5)->get();
        if ($user) {
            foreach ($sameProductsBrand as $sameProductBrand) {
                $sameProductBrand->isFollowed = FollowProduct::where('user_id', $user->user_id)
                    ->where('product_id', $sameProductBrand->product_id)
                    ->exists();
            }
        } else {
            foreach ($sameProductsBrand as $sameProductBrand) {
                $sameProductBrand->isFollowed = false;
            }
        }

        return view('client.ProductDetail', compact('product', 'comments', 'commentCount', 'commentDegree', 'sameProducts', 'sameProductsBrand'));

    } catch (\Exception $e) {
       return response()->view('errors.500', [], 500);
    }


    }



    // only user
    public function getProfile(){

        $user = CustomHelpers::getUser();
        $userInfo = UserInfo::where('user_id',$user->user_id)->first();
        return view('client.ProfilePage',compact('user','userInfo'));
    }

    public function getProfileContent($url){
        $user = CustomHelpers::getUser();
        $userInfo = UserInfo::where('user_id',$user->user_id)->first();

        switch($url){
            case 'user-info-page':
                return view('client.layout.profile-partials.user-info-page',compact('user','userInfo'));

            case 'adress-page':

                return view('client.layout.profile-partials.adress-page',compact('user','userInfo'));

            case 'debit-cart-page':
                return view('client.layout.profile-partials.debit-cart-page',compact('user','userInfo'));

            case 'order-page':
                $waitingSoldProducts = WaitingSoldProduct::where('user_id',$user->user_id)->get();
                foreach ($waitingSoldProducts as $key => $productFeach) {
                    $products = $productFeach->products;
                    foreach ($products as $index => $productDetail) {
                        $product = Product::where('product_id', $productDetail['product_id'])->first();
                        $products[$index]['product'] = $product;
                    }
                    $waitingSoldProducts[$key]->products = $products;
                }


                $soldProducts = SoldProduct::where('user_id',$user->user_id)->get();
                foreach ($soldProducts as $key => $productFeach) {
                    $products = $productFeach->products;
                    foreach ($products as $index => $productDetail) {
                        $product = Product::where('product_id', $productDetail['product_id'])->first();
                        $products[$index]['product'] = $product;
                    }
                    $soldProducts[$key]->products = $products;
                    Log::info($soldProducts);
                }


                return view('client.layout.profile-partials.order-page',compact('waitingSoldProducts','soldProducts'));

            case 'comment-page':
                $comments = ProductComment::where('user_id',$user->user_id)->get();
                return view('client.layout.profile-partials.comment-page', compact('user','userInfo','comments'));

            case 'notification-page':
                return view('client.layout.profile-partials.notification-page');

            default:
                return "";
        }
    }

    public function getBasket()
    {
        $user = CustomHelpers::getUser();
        $basket = Basket::where('user_id', $user->user_id)->first();

        if ($basket) {
            $products = BasketProductModal::retrunData($basket->products);

            $productsByBrand = collect($products)->groupBy(function($product) {
                return $product['product']['brand_id'];
            });
            $basket->productsByBrand = $productsByBrand;
        } else {
            $basket = (object) ['productsByBrand' => collect()];
        }

        $userInfo = UserInfo::where('user_id', $user->user_id)->first();
        return view('client.BasketPage', compact('basket', 'userInfo'));
    }


    public function getFinalizeBasket(){
        $user = CustomHelpers::getUser();
        $user_info = UserInfo::where('user_id',$user->user_id)->first();
        $basket = Basket::where('user_id',$user->user_id)->first();

        // filtered active product on basket
        $products = $basket->products;
        $emptyProducts = [];
        foreach($products as $key=>$product){
            if($product['is_active'] == 1){
                $productInfo =  Product::where('product_id',$product['product_id'])->first();
                $emptyProducts[] = [
                  'count' => $product['count'],
                  'product_id' => $product['product_id'],
                  'product' => $productInfo
                ];
            }
        }
        $basket->products = $emptyProducts;

        return view('client.BasketFinalPage', compact('basket','user_info','user'));
    }




    public function getFavaoriProducts(){
        $user = CustomHelpers::getUser();
        $followedProducts = FollowProduct::where('user_id',$user->user_id)->get();
        $products = collect(); // Boş bir koleksiyon

        foreach ($followedProducts as $followProduct) {
            $product = Product::where('product_id', $followProduct->product_id)->first();
            $product->isFollowed = true;
            if ($product) {
                $products->push($product);
            }
        }

        return view('client.LikedProducts',compact('products'));
    }
}
