<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Free extends Model implements Sortable
{
    use SortableTrait, AdminBuilder, SoftDeletes;

    protected $fillable = ['title', 'content', 'attachFile', 'user_id', 'rank', 'released'];
    protected $table = 'admin_free';

    protected $dates = ['deleted_at'];

    public $sortable = [
        'order_column_name' => 'rank',
        'sort_when_creating' => true,
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(Administrator::class);
    }

}
