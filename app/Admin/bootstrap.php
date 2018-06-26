<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Form\Field\Address;
use App\Admin\Extensions\Form\CKEditor;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;

//use Encore\Admin\Form\Field\CKEditor;

Form::extend('ckeditor', CKEditor::class);
Form::extend('address', Address::class);
//Admin::js('/vendor/chartjs/dist/Chart.min.js');
Admin::js('/vendor/chartjs/dist/Chart.bundle.js');
Admin::js('/vendor/chartjs/samples/utils.js');

//Encore\Admin\Form::forget(['map', 'editor']); \Encore\Admin\Widgets\Navbar
Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {
    //$navbar->left(view('search-bar'));
    $navbar->right(new \App\Admin\Extensions\Nav\Links());
});