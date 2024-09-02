<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Eloquent User modelini Authentıcatable olarak ekleyin.
use Tymon\JWTAuth\Contracts\JWTSubject; // JWTSubject arayüzünü import edin.

class User extends Authenticatable implements JWTSubject // Authenticatable sınıfını miras alın ve JWTSubject arayüzünü uygulayın.
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'user_id'; // Eğer kullanıcı kimlik sütunu user_id ise

    protected $fillable = [
        'name',
        'surname',
        'mail_adress',
        'password',
        'phone_number',
        'role'
    ];

    public function usersInfo()
    {
        return $this->hasOne(UserInfo::class,'user_id','user_id');
    }

    public function mailVerify()
    {
        return $this->hasMany(MailVerification::class,'user_id','user_id');
    }

    public function soldProductsAsDealer()
    {
        return $this->hasMany(SoldProduct::class, 'dealer_id', 'user_id');
    }

    public function soldProductsAsBuyer()
    {
        return $this->hasMany(SoldProduct::class, 'buyer_id', 'user_id');
    }
    public function brands()
    {
        return $this->hasOne(Brand::class, 'user_id', 'user_id');
    }

    public function basket()
    {
        return $this->hasOne(Basket::class, 'user_id', 'user_id');
    }

    public function followOrders()
    {
        return $this->hasMany(FollowProduct::class,'user_id','user_id');
    }

    // JWTSubject arayüzünden gelen metodları uygulayın
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Kullanıcıyı tanımlayan bir benzersiz bir anahtar döndürün
    }

    public function getJWTCustomClaims()
    {
        return []; // Token içine ekstra veriler eklemek için kullanılır
    }

    public function verifyCodes(): HasMany
    {
        return $this->hasMany(VerifyCode::class, 'user_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(ProductComment::class, 'user_id', 'user_id');
    }
}