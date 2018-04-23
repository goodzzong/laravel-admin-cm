<?php

namespace App\Admin\Extensions;

use App\Category;
use App\Customer;
use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExpoter extends AbstractExporter
{
    public function export()
    {
        $currentTime = \Carbon\Carbon::now();

        Excel::create($currentTime, function ($excel) {

            $excel->sheet('Customers', function ($sheet) {

                // Set background color for a specific cell
                /*
                $sheet->getStyle('A1')->applyFromArray(array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'FF0000')
                    )
                ));
                */

                // This logic get the columns that need to be exported from the table data
                $rows = collect($this->getData())->map(function ($item) {

                    $item = $this->customizing($item);

                    //echo $item['category_customer_id']."<br />";
                    return array_only($item, [
                        'user_id',
                        'category_customer_id',
                        'category_sales_id',
                        'category_delivery_id',
                        'manager',
                        'company',
                        'name',
                        'rank',
                        'main_phone',
                        'phone_number',
                        'fax_number',
                        'email',
                        'address1',
                        'address2',
                        'contents'
                    ]);
                });

                //dd($rows);
                //$sheet->fromArray($rows);
                $sheet->rows($rows);

            });

        })->download('xls');
    }

    public function customizing($item)
    {
        if ($item['user_id']) {
            $item['user_id'] = Administrator::find($item['user_id'])->name;
        } else {
            $item['user_id'] = "";
        }

        if ($item['category_customer_id']) {
            $item['category_customer_id'] = Category::find($item['category_customer_id'])->title;

        } else {
            $item['category_customer_id'] = "";
        }

        if ($item['category_sales_id']) {
            $item['category_sales_id'] = Category::find($item['category_sales_id'])->title;
        } else {
            $item['category_sales_id'] = "";
        }

        if ($item['category_delivery_id']) {
            $item['category_delivery_id'] = Category::find($item['category_delivery_id'])->title;
        } else {
            $item['category_delivery_id'] = "";
        }

        return $item;
    }


}