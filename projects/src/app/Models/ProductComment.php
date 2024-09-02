<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    // Tablo adı
    protected $table = 'product_comments';

    // Birincil anahtar
    protected $primaryKey = 'comment_id';

    // Mass assignment ile doldurulabilir alanlar
    protected $fillable = [
        'product_id',
        'user_id',
        'comment',
        'commentRate',
    ];

    /**
     * Ürüne ait olan yorumları almak için tanımlanan ilişki
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    /**
     * Yorumu yapan kullanıcıyı almak için tanımlanan ilişki
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}