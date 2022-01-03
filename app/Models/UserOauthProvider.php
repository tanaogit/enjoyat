<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOauthProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'provider_id',
        'provider_token',
        'provider_refresh_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
