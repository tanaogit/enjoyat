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

    public function scopeAccessFilter($query, $pref, $line, $station)
    {
        return $query->whereHas('accesses', function (Builder $access_query) use ($pref, $line, $station) {
            $access_query
                ->when($pref, function ($q, $pref) {
                    return $q->where('prefecture', $pref);
                })
                ->when($line, function ($q, $line) {
                    return $q->where('line', $line);
                })
                ->when($station, function ($q, $station) {
                    return $q->where('station_name', $station);
                });
        });
    }
    
    public function scopeFreeWordFilter($query, $freeword)
    {
        return $query->when($freeword, function ($q, $freeword) {
            return $q->where('name', 'like', "%$freeword%");
        });
    }
    
    public function scopeBusinessDaysFilter($query, $businessdays)
    {
        if ($businessdays === null) {return;}
        if (gettype($businessdays) !== 'array') {return;}

        return $query
            ->when(in_array('sunday', $businessdays), function ($q) {
                return $q->orWhereHas('holidays', function (Builder $holidays_query) {
                    $holidays_query->Where('sunday', '0');
                });
            })
            ->when(in_array('monday', $businessdays), function ($q) {
                return $q->orWhereHas('holidays', function (Builder $holidays_query) {
                    $holidays_query->Where('monday', '0');
                });
            })
            ->when(in_array('tuesday', $businessdays), function ($q) {
                return $q->orWhereHas('holidays', function (Builder $holidays_query) {
                    $holidays_query->Where('tuesday', '0');
                });
            })
            ->when(in_array('wednesday', $businessdays), function ($q) {
                return $q->orWhereHas('holidays', function (Builder $holidays_query) {
                    $holidays_query->Where('wednesday', '0');
                });
            })
            ->when(in_array('thursday', $businessdays), function ($q) {
                return $q->orWhereHas('holidays', function (Builder $holidays_query) {
                    $holidays_query->Where('thursday', '0');
                });
            })
            ->when(in_array('friday', $businessdays), function ($q) {
                return $q->orWhereHas('holidays', function (Builder $holidays_query) {
                    $holidays_query->Where('friday', '0');
                });
            })
            ->when(in_array('saturday', $businessdays), function ($q) {
                return $q->orWhereHas('holidays', function (Builder $holidays_query) {
                    $holidays_query->Where('saturday', '0');
                });
            });
    }
    
    public function scopeEvaluationFilter($query, $evaluation)
    {
        if ($evaluation === '') {return;}

        return $query->when($evaluation, function ($q, $evaluation) {
            return $q->withAvg('Posts', 'eva_average')->having('posts_avg_eva_average', '>=', $evaluation);
        });
    }
    
    public function scopePaymentsFilter($query, $payments)
    {
        if ($payments === null) {return;}
        if (gettype($payments) !== 'array') {return;}

        return $query->whereHas('payments', function (Builder $payments_query) use ($payments) {
            $payments_query->whereIn('id', $payments);
        });
    }
    
    public function scopeCouponFilter($query, $coupon)
    {
        if ($coupon === '0') {
            return $query->with('products.coupons')->doesntHave('products.coupons');
        } elseif ($coupon === '1') {
            return $query->with('products.coupons')->has('products.coupons');
        }
    }
    
    public function scopeGenresFilter($query, $genres)
    {
        if ($genres === null) {return;}
        if (gettype($genres) !== 'array') {return;}

        return $query->with('products.genres')
            ->whereHas('products.genres', function ($q) use ($genres) {
                $q->whereIn('id', $genres);
            });
    }
}
