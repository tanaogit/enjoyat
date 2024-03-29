<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class StoreImage extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'image',
        'category',
        'store_id',
    ];

    /**
     * categoryカラムに入りうる値かどうかを判定
     *
     * @return bool
     */
    public static function inCategoryArray($category)
    {
        return in_array($category, ['foods', 'drinks', 'others'], true);
    }
}
