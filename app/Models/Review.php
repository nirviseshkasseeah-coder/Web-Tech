<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    // Ashutosh: review model and relationship mapping for the API/UI data layer.
    protected $table = 'reviews';
    protected $primaryKey = 'ReviewID';
    public $timestamps = false;

    protected $fillable = [
        'UserID',
        'ProductID',
        'Rating',
        'Comment',
    ];

    protected $casts = [
        'CreatedAt' => 'datetime',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ProductID');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }
}
//This model defines a Review with ReviewID primary key, no timestamps, fillable fields (UserID, ProductID, Rating, Comment),
//casts CreatedAt as datetime, and belongs-to relationships with both Product and User.
