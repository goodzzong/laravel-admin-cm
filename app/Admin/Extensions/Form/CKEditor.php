<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class CKEditor extends Field
{
    protected $view = 'admin.ckeditor';

    public static $js = [
        '/packages/ckeditor/ckeditor.js',
        '/packages/ckeditor/adapters/jquery.js',
    ];



    public function render()
    {
        $this->script = "$('textarea.{$this->getElementClass()}').ckeditor();";

        return parent::render();
    }
}