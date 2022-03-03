<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\UserResetPassword as ResetPasswordNotification;
use App\Notifications\UserVerifyEmail as VerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'name',
        'icon',
        'tel',
        'zipcode',
        'prefecture',
        'city',
        'street_address',
        'gender',
        'birthday',
        'social_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('category');
    }

    public function registerProducts()
    {
        return $this->belongsToMany(Product::class)->wherePivot('category', 'register')->withTimestamps();
    }

    public function bookmarkProducts()
    {
        return $this->belongsToMany(Product::class)->wherePivot('category', 'bookmark')->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function provider()
    {
        return $this->hasOne(UserOauthProvider::class);
    }

    /**
    * パスワードリセット通知をユーザーに送信
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * メールアドレス検証通知をユーザーに送信
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }
}
