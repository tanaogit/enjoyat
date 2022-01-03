<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerOauthProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'provider_id',
        'provider_token',
        'provider_refresh_token',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}
