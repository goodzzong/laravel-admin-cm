<?php

namespace App;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Customer extends Model implements Sortable
{
    use SoftDeletes, AdminBuilder, SortableTrait;

    protected $table = 'customers';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'user_id',
        'm_id',
        'category_customer_id',
        'category_sales_id',
        'category_delivery_id',
        'manager',
        'importance',
        'company',
        'name',
        'rank',
        'main_phone',
        'phone_number',
        'fax_number',
        'email',
        'zipcode',
        'address1',
        'address2',
        'extra_info',
        'contents',
        'picture',
        'attach_files',
    ];
    public $sortable = [
        'order_column_name' => '',
        'sort_when_creating' => false,
    ];

    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function user()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function scopeUserId($query, $user)
    {
        //return $this->belongsTo(Administrator::class);

        return $query->where('user_id', $user->id);
    }

    public function scopeTotals($query)
    {
        // dd($query);
        return $query->select('user_id', DB::raw('count(*) as total'))->groupBy('user_id')->orderBy('total', 'desc')->get();
    }

    public function scopeImportance($query, $importance)
    {
        if (!in_array($importance, ['1', '2', '3', '4', '5'])) {
            return $query;
        }

        return $query->where('importance', $importance);
    }

    public function scopeCategoryCustomerId($query, $category)
    {
        if (!isset($category)) {
            return $query;
        }

        if ($category == 0) {
            return $query->where('category_customer_id', '!=', '');
        } else {
            $kinds = $this->getCategoryId('parent_id', $category);
            return $query->whereIn('category_customer_id', $kinds);
        }
    }

    public function scopeCategorySalesId($query, $category)
    {
        if (!isset($category)) {
            return $query;
        }

        if ($category == 0) {
            return $query->where('category_sales_id', '!=', '');
        } else {
            $kinds = $this->getCategoryId('parent_id', $category);
            return $query->whereIn('category_sales_id', $kinds);
        }
    }

    public function scopeCategoryDeliveryId($query, $category)
    {
        if (!isset($category)) {
            return $query;
        }

        if ($category == 0) {
            return $query->where('category_delivery_id', '!=', '');
        } else {
            $kinds = $this->getCategoryId('parent_id', $category);
            return $query->whereIn('category_delivery_id', $kinds);
        }
    }

    public function getCategoryId($column, $category)
    {
        $kinds = [];
        $checkCount = $this->getCategoryCheckCount($column, $category);

        if ($checkCount > 0) {
            $categoryChecks = $this->getCategoryCheck($column, $category);

            foreach ($categoryChecks as $categoryCheck) {
                //echo $categoryCheck->title;

                $checkCount2 = $this->getCategoryCheckCount($column, $categoryCheck->id);

                if ($checkCount2 > 0) {
                    $categoryChecks2 = $this->getCategoryCheck($column, $categoryCheck->id);

                    foreach ($categoryChecks2 as $categoryCheck2) {

                        $checkCount3 = $this->getCategoryCheckCount($column, $categoryCheck2->id);

                        if ($checkCount3 > 0) {

                        } else {
                            $kinds[] = $categoryCheck2->id;
                        }

                    }

                } else {
                    $kinds[] = $categoryCheck->id;
                }

            }

        } else {
            $kinds[] = $category;
        }

        return $kinds;
    }

    public function getCategoryCheck($column, $category)
    {
        $categoryChecks = DB::table('admin_categories')->where($column, $category)->get();

        return $categoryChecks;
    }

    public function getCategoryCheckCount($column, $category)
    {
        $checkCount = DB::table('admin_categories')->where($column, $category)->count();

        return $checkCount;
    }

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
