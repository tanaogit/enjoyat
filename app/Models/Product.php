<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'unitprice',
        'description',
        'image',
        'store_id',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('category');
    }

    public function bookmarkUsers()
    {
        return $this->belongsToMany(User::class)->withPivot('category')->wherePivot('category', 'bookmark');
    }

    /**
     * パラメータに与えられる住所情報に合致する店舗の登録商品のみを抽出する処理
     * ※パラメータがnullの場合は処理を実行せずreturn
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $pref
     * @param string $city
     * @param string $street_address
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeStoreAddressFilter($query, $pref, $city, $street_address = null)
    {
        if (empty($pref)) return;

        return $query->whereHas('store', function (Builder $query) use ($pref, $city, $street_address) {
            $query
                ->when($pref, function ($query, $pref) {
                    return $query->where('prefecture', $pref);
                })
                ->when($city, function ($query, $city) {
                    return $query->where('city', $city);
                })
                ->when($street_address, function ($query, $street_address) {
                    return $query->where('street_address', $street_address);
                });
        });
    }

    /**
     * パラメータに与えられるジャンルのいずれか1つ以上が合致する登録商品を全て抽出する処理
     * ※パラメータに値がセットされていなければ処理を実行せずreturn
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param array $genres
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeGenresFilter($query, $genres)
    {
        if (!is_array($genres)) return;
        if (empty($genres)) return;

        return $query->whereHas('genres', function ($query) use ($genres) {
            $query->whereIn('id', $genres);
        });
    }
}
