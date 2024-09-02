<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class UserFilterController extends Controller
{
    public function brandsProductFilter(Request $request)
    {
        try {
            $filterData = $request->all();

            $query = Product::query();
            $query->where('active_sales', 1);

            foreach ($filterData as $key => $value) {
                if ($key == 'brand_id') {
                    $query->where('brand_id', $value);
                } elseif ($key == 'category_id') {
                    $query->where('category_id', $value);
                } else {
                    if (!(($key === "priceMin" || $key === "priceMax") && $value == 0)) {
                        $query->whereRaw("JSON_EXTRACT(product_detail, '$.$key') = ?", [$value]);
                    }
                }
            }

            $products = $query->get();
            return response()->json([
                'success' => true,
                'message' => 'Filtreler başarıyla uygulandı.',
                'data' => $products
            ]);
        } catch (\Exception $e) {
            Log::error('Error occurred: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Bir hata oluştu.'], 500);
        }
    }



}