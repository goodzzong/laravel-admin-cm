<?php

namespace App\Admin\Extensions\search;

use App\Category;
use App\Customer;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\CustomerContent;
use Encore\Admin\Layout\Row;
use Illuminate\Http\Request;

class CustomerList
{

    use ModelForm;

    public static function search()
    {
        $content = new CustomerContent();
        return $content->row(function (Row $row) {


            $row->column(12, function (Column $column) {

                $column->append(CustomerList::categoryType());

            });

            //$content->body($this->grid());

        });
    }

    public static function categoryType()
    {
        $categoryCustomers = Category::selectOptionsIns(1);
        $categorySales = Category::selectOptionsIns(2);
        $categoryDeliverys = Category::selectOptionsIns(3);

        return view('admin.customers.search-list', [
            'categoryCustomers' => $categoryCustomers,
            'categorySales' => $categorySales,
            'categoryDeliverys' => $categoryDeliverys,
        ]);

    }

    protected function grid()
    {
        return Admin::grid(Customer::class, function (Grid $grid) {

        });
    }


}