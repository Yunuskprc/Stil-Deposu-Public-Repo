<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'user_id',
        'brands_name',
        'logoURI',
        'cardImageURI'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }
}
