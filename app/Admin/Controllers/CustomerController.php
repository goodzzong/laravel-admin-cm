<?php

namespace App\Admin\Controllers;

use App\Category;
use App\Customer;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class CustomerController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('고객관리');
            $content->description('리스트');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('고객관리');
            $content->description('수정');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('고객관리');
            $content->description('등록');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Customer::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Admin::form(Customer::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->hidden('extra_info')->attribute(['class' => 'postcodify_extra_info']);

            $form->select('category_id','분류')->options(Category::selectOptions())->rules('required', [
                'required' => '성명을 입력해 주세요.',
            ]);

            $form->text('name','성명')
                ->placeholder('성명을 입력해 주세요.')
                ->setWidth(3)
                ->rules('required', [
                'required' => '성명을 입력해 주세요.',
            ]);

            $form->text('rank','직급')
                ->placeholder('직급을 입력해 주세요.')
                ->setWidth(5);

            $form->text('company','회사')
                ->placeholder('회사명을 입력해 주세요.')
                ->setWidth(5);


            $form->mobile('main_phone','대표전화')
                ->placeholder('대표전화')
                ->options(['mask' => '999 9999 9999']);
            $form->mobile('phone_number','휴대폰')
                ->placeholder('휴대폰')
                ->options(['mask' => '999 9999 9999']);
            $form->mobile('fax_number','팩스')
                ->placeholder('팩스')
                ->options(['mask' => '999 9999 9999']);

            $form->address('zipcode','우편번호')
                ->setWidth('2')
                ->placeholder('우편번호')
                ->attribute(['class' => 'postcodify_postcode5 form-control']);

            $form->text('address1','주소')
                ->placeholder('주소')
                ->attribute(['class' => 'postcodify_address form-control']);

            $form->text('address2','상세주소')
                ->placeholder('상세주소를 입력해 주세요.')
                ->attribute(['class' => 'postcodify_details form-control']);

            $form->email('email','이메일')
                ->setWidth('5')
                ->placeholder('이메일을 입력해 주세요.')
                ->rules('required');

            $form->textarea('memo','메모')
                ->placeholder('메모를 입력해 주세요.');
            $form->textarea('contents','요구사항')
                ->placeholder('요구사항을 입력해 주세요.');

            $form->image('picture','명함이미지')->removable();

            $form->multipleFile('attach_files','관련파일')->removable();

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
