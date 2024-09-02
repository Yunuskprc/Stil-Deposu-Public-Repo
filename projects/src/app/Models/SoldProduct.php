<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldProduct extends Model
{
    use HasFactory;

    // Veritabanı tablosu adı
    protected $table = 'sold_products';

    // Otomatik zaman damgalarını etkinleştirin
    public $timestamps = true;

    // JSON alanları için doldurulabilir özellikler
    protected $casts = [
        'products' => 'array',
        'order_address' => 'array',
        'order_debit_card' => 'array',
    ];

    // Varsayılan olarak oluşturulacak ve güncellenecek olan sütunlar
    protected $fillable = [
        'user_id',
        'brand_id',
        'products',
        'order_address',
        'order_debit_card',
    ];

    // İlişkileri tanımlayın (optional)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
}