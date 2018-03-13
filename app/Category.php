<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ModelTree, AdminBuilder;

    protected $table = 'admin_categories';

    public function customers()
    {
        return $this->hasMany(\App\Customer::class);
    }

    public function scopeParentId()
    {
        return $this->where('parent_id', 1);
    }

    public function scopeParentId2()
    {
        return $this->where('parent_id', 3);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function brothers()
    {
        return $this->parent->children();
    }

    public static function options($id)
    {
        if (!$self = static::find($id)) {
            return [];
        }

        return $self->brothers()->pluck('title', 'id');
    }
}
