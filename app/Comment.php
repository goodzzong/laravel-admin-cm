<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;

    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'user_id',
        'parent_id',
        'content',
    ];

    protected $hidden = [
        'user_id',
        'commentable_type',
        'commentable_id',
        'parent_id',
        'deleted_at',
    ];

    protected $with = [
        'user'
    ];

    protected $dates = [
        'deleted_at',
    ];

    /* Relationships */
    public function user()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->latest();
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

}
