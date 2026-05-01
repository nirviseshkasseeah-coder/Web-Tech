<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    // Ashutosh: Eloquent product model ownership including fillable fields and relationships.
    protected $table = 'products';
    protected $primaryKey = 'ProductID';
    public $timestamps = false;

    protected $fillable = [
        'Name',
        'Description',
        'Price',
        'Points',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'ProductID', 'ProductID');
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(
            Order::class,
            'ordercontains',
            'ProductID',
            'OrderID',
            'ProductID',
            'OrderID'
        )->withPivot('Quantity', 'TotalPrice');
    }

    // Category replacements
    public function drink()
    {
        return $this->hasOne(Drink::class, 'ProductID', 'ProductID');
    }

    public function dessert()
    {
        return $this->hasOne(Dessert::class, 'ProductID', 'ProductID');
    }

    public function coffee()
    {
        return $this->hasOne(Coffee::class, 'ProductID', 'ProductID');
    }

    public function milkshake()
    {
        return $this->hasOne(Milkshake::class, 'ProductID', 'ProductID');
    }
}
//This model defines a Product with ProductID primary key, no timestamps, fillable attributes (Name, Description, Price, Points),
//and relationships: reviews (one-to-many), orders (many-to-many via ordercontains with Quantity/TotalPrice), plus category-specific
//one-to-one relationships with Drink, Dessert, Coffee, and Milkshake models.

