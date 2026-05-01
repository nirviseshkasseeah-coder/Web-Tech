<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Ashutosh: user model relationships used by reviews and token ownership.
    protected $table = 'users';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    protected $fillable = [
        'Username',
        'Email',
        'Password',
    ];

    protected $hidden = [
        'Password',
    ];

    // Laravel auth expects a password accessor, but this schema uses Password.
    public function getAuthPassword(): string
    {
        return $this->Password ?? '';
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'UserID', 'UserID');
    }

    public function apiTokens(): HasMany
    {
        return $this->hasMany(ApiToken::class, 'UserID', 'UserID');
    }
}
