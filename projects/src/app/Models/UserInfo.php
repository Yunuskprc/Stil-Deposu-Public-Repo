<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $table = 'users_info';
    protected $primaryKey = 'info_id';
    protected $fillable = [
        'user_id',
        'adress',
        'mail_verify',
        'pp_url',
        'birth_date',
        'cards'
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'adress' => 'array',
        'cards' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
