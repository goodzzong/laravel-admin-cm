<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = [
        'user_id',
        'customer_id',
        'sendNumber',
        'receiveNumber',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(Administrator::class);
    }
}
