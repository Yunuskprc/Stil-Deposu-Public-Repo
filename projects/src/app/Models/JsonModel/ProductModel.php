<?php

namespace App\Models\JsonModel;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Helpers\CustomHelpers;

class ProductModel
{
    public static function createProductJson(Request  $request, $fileName){

        $brand = CustomHelpers::getBrandForAuthenticatedUser();
        $category = Category::where('category_id',$request->category_id)->first();
        $product_detail = $request->only(['proc_name','proc_desc','size','male',
        'person_count','material','style','formType','skinType','bindType','color','stock','price',]);

        $product_detail['file_names'] = $fileName;

        $data =  [
            'category_id' => $category->category_id,
            'brand_id' => $brand->brand_id,
            'category_name' => $category->category_name,
            'brand_name' => $brand->brands_name,
            'product_detail' => $product_detail
        ];
        return $data;
    }
}
