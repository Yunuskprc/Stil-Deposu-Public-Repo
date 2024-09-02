<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingSoldProduct extends Model
{
    use HasFactory;

    // Veritabanı tablosu adı
    protected $table = 'waiting_sold_products';

    // Otomatik zaman damgalarını devre dışı bırakmak için
    public $timestamps = true;

    // Kütüphane tarafından varsayılan olan ID'yi otomatik olarak artır
    protected $primaryKey = 'waiting_id';

    // JSON alanları için doldurulabilir özellikler
    protected $casts = [
        'products' => 'array',
        'order_address' => 'array',
        'order_debit_card' => 'array',
    ];

    // Kütüphane tarafından varsayılan olan ID'yi otomatik olarak artır
    public $incrementing = true;

    // Varsayılan olarak oluşturulacak ve güncellenecek olan sütunlar
    protected $fillable = [
        'user_id',
        'brand_id',
        'products',
        'order_address',
        'order_debit_card',
        'is_completed'
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