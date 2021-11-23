<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Store extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'tel',
        'introduction',
        'zipcode',
        'prefecture',
        'city',
        'street_address',
        'business_time',
        'owner_id',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    public function accesses()
    {
        return $this->hasMany(Access::class);
    }

    public function storeimages()
    {
        return $this->hasMany(StoreImage::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class);
    }
}
