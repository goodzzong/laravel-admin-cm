<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollectPrice extends Model
{
    use SoftDeletes;

    protected $table = 'collect_prices';
    protected $fillable = [
        'customer_id', 'sales_id', 'price', 'title',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sales()
    {
        return$this->belongsTo(Sale::class);
    }
}
