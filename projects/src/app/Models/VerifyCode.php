<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyCode extends Model
{
    use HasFactory;
    protected $table = 'verify_codes';
    protected $primaryKey = 'code_id';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'verify_code',
        'isComp',
        'isExp',
        'expires_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}