<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'category_id',
        'brand_id',
        'category_name',
        'brand_name',
        'product_detail',
        'active_sales'
    ];

    protected $casts = [
        'product_detail' => 'json',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    public function soldProduct()
    {
        return $this->belongsTo(SoldProduct::class);
    }

   public function followProducts()
    {
        return $this->hasMany(FollowProduct::class, 'product_id', 'product_id');
    }

    public function comments()
    {
        return $this->hasMany(ProductComment::class, 'product_id', 'product_id');
    }

    public function baskets()
    {
        return $this->belongsToMany(Basket::class, 'basket_products', 'product_id', 'basket_id');
    }
}