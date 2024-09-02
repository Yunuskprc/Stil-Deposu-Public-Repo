<?php

namespace App\Models\JsonModel;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class BasketProductModal
{
    public static function retrunData($products)
    {
        $data = [];

        try {
            if (!empty($products) && is_array($products)) {
                foreach ($products as $product) {
                    $product_detail = Product::where('product_id', $product['product_id'])->first();

                    if ($product_detail) {
                        $data[] = [
                            'count' => $product['count'],
                            'is_active' => $product['is_active'],
                            'product_id' => $product['product_id'],
                            'product' => $product_detail->toArray()
                        ];
                    } else {
                        $data[] = [
                            'count' => $product['count'],
                            'product_id' => $product['product_id'],
                            'is_active' => $product['is_active'],
                            'product' => [] // Boş dizi döndürür
                        ];
                    }
                }
            }

            return $data;

        } catch (\Exception $e) {
            Log::error('Error occurred while processing data: ' . $e->getMessage());
            return [];
        }
    }
}
