<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $table='basket';
    protected $primaryKey = 'basket_id';
    protected $fillable = [
        'user_id',
        'products',
    ];

    protected $casts = [
        'products' => 'json',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getProducts()
    {
        return $this->belongsToMany(Product::class, 'basket_products', 'basket_id', 'product_id');
    }

}
