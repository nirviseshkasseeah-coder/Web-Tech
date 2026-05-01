<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiToken extends Model
{
    // Ryan: token model used by the custom API authentication flow.
    protected $table = 'api_tokens';
    protected $primaryKey = 'TokenID';
    public $timestamps = false;

    protected $fillable = [
        'UserID',
        'Token',
        'ExpiresAt',
        'CreatedAt',
    ];

    protected $casts = [
        'ExpiresAt' => 'datetime',
        'CreatedAt' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
}
