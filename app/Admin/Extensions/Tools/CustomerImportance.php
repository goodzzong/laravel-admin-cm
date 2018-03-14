<?php

namespace App\Admin\Extensions\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class CustomerImportance extends AbstractTool
{
    public function script()
    {
        $url = Request::fullUrlWithQuery(['importance' => '_importance_']);

        return <<<EOT

$('input:radio.importance').change(function () {

    var url = "$url".replace('_importance_', $(this).val());

    $.pjax({container:'#pjax-container', url: url });

});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = [
            'all'   => 'All',
            '5'     => '★★★★★',
            '4'     => '★★★★',
            '3'     => '★★★',
            '2'     => '★★',
            '1'     => '★',
        ];

        return view('admin.tools.importance', compact('options'));
    }
}
