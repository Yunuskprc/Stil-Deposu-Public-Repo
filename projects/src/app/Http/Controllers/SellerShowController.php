<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\CustomHelpers;
use App\Models\User;
use App\Models\Product;
use App\Models\WaitingSoldProduct;
use App\Models\SoldProduct;
use Illuminate\Support\Facades\Log;
use App\Models\UserInfo;

class SellerShowController extends Controller
{
    public function index(Request $request)
    {
        return view('admin-panel.index');
    }

    public function updateProc(Request $request){
        $user = CustomHelpers::getBrandForAuthenticatedUser();
        $brand_id = $user->brand_id;
        $products = Product::where(['brand_id'=>$brand_id])->orderBy('active_sales', 'desc')->get();
        return view('admin-panel.updateProc',compact('products'));
    }


    public function profile(Request $request){
        $user = CustomHelpers::getUser();
        $userInfo = UserInfo::where(['user_id'=>$user->user_id])->first();
        return view('admin-panel.profile',compact('user','userInfo'));
    }

    public function getProfileContent($url){
        $user = CustomHelpers::getUser();
        $userInfo = UserInfo::where('user_id',$user->user_id)->first();

        switch($url){
            case 'user-info-page':
                return view('admin-panel.layout.profile-partials.user-info-page',compact('user','userInfo'));

            case 'adress-page':

                return view('admin-panel.layout.profile-partials.adress-page',compact('user','userInfo'));

            case 'debit-cart-page':
                return view('admin-panel.layout.profile-partials.debit-cart-page',compact('user','userInfo'));

            case 'image-delete-upload-page':
                $brands = CustomHelpers::getBrandForAuthenticatedUser();
                return view('admin-panel.layout.profile-partials.image-delete-upload-page',compact('user','userInfo','brands'));

            case 'mail-verify-modal':
                return view('admin-panel.layout.profile-partials.mail-verify-modal', compact('user','userInfo'));

            default:
                return "";
        }
    }


    public function profileAdress(Request $request){
        $user = CustomHelpers::getUser();
        $userInfo = UserInfo::where(['user_id'=>$user->user_id])->first();
        return view('admin-panel.profileAdress',compact('user','userInfo'));
    }

    public function profileCards(Request $request){
        $user = CustomHelpers::getUser();
        $userInfo = UserInfo::where(['user_id'=>$user->user_id])->first();
        return view('admin-panel.profileCards',compact('user','userInfo'));
    }


    public function profileImages(Request $request){
        $brands = CustomHelpers::getBrandForAuthenticatedUser();
        $user = CustomHelpers::getUser();
        $userInfo = UserInfo::where(['user_id'=>$user->user_id])->first();
        return view('admin-panel.profileImages',compact('user','brands','userInfo'));
    }



    public function salesFollow(Request $request){

        $brands = CustomHelpers::getBrandForAuthenticatedUser();

        $waitingSales = WaitingSoldProduct::where('brand_id', $brands->brand_id)->get();

        foreach($waitingSales as $key => $product) {
            $updatedProducts = [];
            foreach($product['products'] as $productDetail) {
                $productDetail['product'] = Product::where('product_id', $productDetail['product_id'])->first()->toArray();
                $updatedProducts[] = $productDetail;
            }
            $user = User::Where('user_id',$product['user_id'])
                    ->select('name','surname','mail_adress','phone_number')
                    ->first()->toArray();
            $waitingSales[$key]['products'] = $updatedProducts;
            $waitingSales[$key]['user'] = $user;
        }


        $soldProducts = SoldProduct::where('brand_id',$brands->brand_id)->get();
        foreach($soldProducts as $key => $product){
            $updatedProducts = [];
            $user = User::Where('user_id',$product['user_id'])
                    ->select('name','surname','mail_adress','phone_number')
                    ->first()->toArray();
            $soldProducts[$key]['user'] = $user;
            $totalPrice = 0;
            foreach($product['products'] as $productDetail){
                $productPrice = Product::where('product_id',$productDetail['product_id'])->first();
                $totalPrice += $productDetail['count'] * $productPrice->product_detail['price'];
            }
            $soldProducts[$key]['totalPrice'] = $totalPrice;
        }
        return view('admin-panel.FollowSales',compact('waitingSales','soldProducts'));
    }


}