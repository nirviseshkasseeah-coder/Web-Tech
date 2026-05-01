<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'CategoryID';
    public $timestamps = false;

    protected $fillable = [
        'CategoryName',
        'Description',
    ];

    // Starter assumption: products table stores CategoryID as a foreign key.
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'CategoryID', 'CategoryID');
    }
}
