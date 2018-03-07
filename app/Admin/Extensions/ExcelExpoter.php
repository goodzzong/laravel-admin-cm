<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\AbstractExporter;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Style_Fill;

class ExcelExpoter extends AbstractExporter
{
    public function export()
    {
        Excel::create('test', function($excel) {

            $excel->sheet('test2', function($sheet) {


                // Set background color for a specific cell
                $sheet->getStyle('A1')->applyFromArray(array(
                    'fill' => array(
                        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'FF0000')
                    )
                ));

                // This logic get the columns that need to be exported from the table data
                $rows = collect($this->getData())->map(function ($item) {
                    return array_only($item, ['id', 'name', 'company', 'main_phone', 'phone_number']);
                });

                $sheet->rows($rows);

            });

        })->export('xls');
    }
}