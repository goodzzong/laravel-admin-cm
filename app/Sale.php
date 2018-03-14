<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id', 'placeOfDelivery', 'price', 'sales_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
