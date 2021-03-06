<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;


class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Dashboard');
            $content->description('Description...');

            $content->row(function (Row $row) {

                $row->column(12, function (Column $column) {
                    $column->append(view(('welcome')));
                });

            });
            $content->row(Dashboard::title());

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::collectprice());
                });

                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::ranking());
                });
            });

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::business());
                });

                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::free());
                });

            });

            $content->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::mycustomers());
                });

                $row->column(6, function (Column $column) {
                    $column->append(Dashboard::customers());
                });

            });



        });
    }
    public function info()
    {
        echo phpinfo();
    }
}
