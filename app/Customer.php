<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Customer extends Model implements Sortable
{
    use SoftDeletes, AdminBuilder, SortableTrait;

    protected $table = 'customers';

    protected $dates = ['deleted_at'];

    public $sortable = [
        'order_column_name' => 'rank',
        'sort_when_creating' => true,
    ];

    public function getAttachFilesAttribute($attach_files)
    {
        if (is_string($attach_files)) {
            return json_decode($attach_files, true);
        }

        return $attach_files;
    }

    public function setAttachFilesAttribute($attach_files)
    {
        if (is_array($attach_files)) {
            $this->attributes['attach_files'] = json_encode($attach_files);
        }
    }

}
