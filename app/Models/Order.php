<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    // Ashutosh: order/product relationship mapping through the pivot table.
    protected $table = 'orders';
    protected $primaryKey = 'OrderID';
    public $timestamps = false;

    protected $fillable = [
        'UserID',
        'OrderDate',
        'Status',
        'TotalAmount',
    ];

    // One order can contain many products, and each product can appear in many orders.
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'ordercontains', 'OrderID', 'ProductID', 'OrderID', 'ProductID')
            ->withPivot('Quantity', 'TotalPrice');
    }
}
