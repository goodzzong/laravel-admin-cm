<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Sale extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'sales';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'customer_id',
        'placeOfDelivery',
        'price',
        'collectPrice1',
        'collectPrice2',
        'collectPrice3',
        'collectPrice4',
        'collectPrice5',
        'collectPrice6',
        'collectPrice7',
        'collectPrice8',
        'collectPrice9',
        'collectPrice10',
        'collectPriceAll',
        'noCollectPrice',
        'tax',
        'attach_sales_file',
        'sales_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeCustomerId($query, $customerId)
    {
        if (!isset($customerId)) {
            return $query;
        }
      //  dd($query);
        return $query->where('customer_id', $customerId);
    }

}
