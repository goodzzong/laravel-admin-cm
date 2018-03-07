<?php

namespace App\Admin\Extensions\Tools;

use App\Category;
use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Facades\Request;

class CustomerCategory extends AbstractTool
{
    protected function script()
    {
        $url = Request::fullUrlWithQuery(['category' => '_category_']);

        return <<<EOT

$('.customer-category').change(function () {
    var url = "$url".replace('_category_', $(this).val());

    $.pjax({container:'#pjax-container', url: url });
});

EOT;
    }

    public function render()
    {
        Admin::script($this->script());

        $options = Category::selectOptions();

        return view('admin.tools.category', compact('options'));
    }
}