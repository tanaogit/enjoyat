<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class Store extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 割り当てが可能な属性
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

    /**
     * パラメータに与えられるアクセス条件に合致する登録店舗のみを抽出する処理
     * ※パラメータがnullの場合は処理を実行せずreturn
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $pref
     * @param string $line
     * @param string $station
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeAccessFilter($query, $pref, $line, $station)
    {
        if (empty($pref)) return;
        
        return $query->whereHas('accesses', function (Builder $query) use ($pref, $line, $station) {
            $query
                ->when($pref, function ($query, $pref) {
                    return $query->where('prefecture', $pref);
                })
                ->when($line, function ($query, $line) {
                    return $query->where('line', $line);
                })
                ->when($station, function ($query, $station) {
                    return $query->where('station_name', $station);
                });
        });
    }

    /**
     * パラメータに与えられるフリーワードを含む店舗名の登録店舗のみを抽出する処理
     * ※パラメータに値がセットされていなければ処理を実行せずreturn
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $freeword
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeFreeWordFilter($query, $freeword)
    {
        return $query->when($freeword, function ($query, $freeword) {
            // フリーワードのメタ文字をエスケープし検索
            return $query->where('name', 'like', '%' . addcslashes($freeword, '%_\\') . '%');
        });
    }

    /**
     * パラメータに与えられる営業日のいずれか1日でも営業している登録店舗を全て抽出する処理
     * ※パラメータに値がセットされていなければ処理を実行せずreturn
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param array $businessdays
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeBusinessDaysFilter($query, $businessdays)
    {
        if (!is_array($businessdays)) return;
        if (empty($businessdays)) return;

        return $query->whereHas('holidays', function (Builder $query) use ($businessdays) {
            $query->where(function ($query) use ($businessdays) {
                $query
                    ->when(in_array('sunday', $businessdays), function ($query) {
                        return $query->orWhere('sunday', '0');
                    })
                    ->when(in_array('monday', $businessdays), function ($query) {
                        return $query->orWhere('monday', '0');
                    })
                    ->when(in_array('tuesday', $businessdays), function ($query) {
                        return $query->orWhere('tuesday', '0');
                    })
                    ->when(in_array('wednesday', $businessdays), function ($query) {
                        return $query->orWhere('wednesday', '0');
                    })
                    ->when(in_array('thursday', $businessdays), function ($query) {
                        return $query->orWhere('thursday', '0');
                    })
                    ->when(in_array('friday', $businessdays), function ($query) {
                        return $query->orWhere('friday', '0');
                    })
                    ->when(in_array('saturday', $businessdays), function ($query) {
                        return $query->orWhere('saturday', '0');
                    });
            });
        });
    }

    /**
     * パラメータに与えられる口コミ評価点以上の登録店舗のみを抽出する処理
     * ※パラメータがnullの場合は処理を実行せずreturn
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $evaluation
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeEvaluationFilter($query, $evaluation)
    {
        return $query->when($evaluation, function ($query, $evaluation) {
            return $query->withAvg('Posts', 'eva_average')->having('posts_avg_eva_average', '>=', $evaluation);
        });
    }

    /**
     * パラメータに与えられる支払い方法のいずれか1つ以上の支払い方法を含む登録店舗を全て抽出する処理
     * ※パラメータに値がセットされていなければ処理を実行せずreturn
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param array $payments
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePaymentsFilter($query, $payments)
    {
        if (!is_array($payments)) return;
        if (empty($payments)) return;

        return $query->whereHas('payments', function (Builder $query) use ($payments) {
            $query->whereIn('id', $payments);
        });
    }

    /**
     * パラメータに与えられるクーポンの有無条件を元に登録店舗を抽出する処理
     * ※パラメータがnullの場合は処理を実行せずreturn
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $coupon
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeCouponFilter($query, $coupon)
    {
        if ($coupon === '0') {
            return $query->doesntHave('products.coupons');
        } elseif ($coupon === '1') {
            return $query->has('products.coupons');
        }
    }

    /**
     * パラメータに与えられるジャンルのいずれか1つ以上が合致する登録店舗を全て抽出する処理
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

        return $query->whereHas('products.genres', function ($query) use ($genres) {
            $query->whereIn('id', $genres);
        });
    }
}
