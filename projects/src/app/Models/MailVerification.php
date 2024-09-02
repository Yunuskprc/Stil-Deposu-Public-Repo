<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailVerification extends Model
{
    use HasFactory;

    protected $table = 'mail_verification';
    protected $primaryKey = 'id';
    protected $fillable = [
      'user_id',
      'verification_code',
      'created_at',
      'exp_at',
      'is_complicated'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'exp_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
