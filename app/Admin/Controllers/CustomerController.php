<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Tools\CustomerCategory;
use App\Admin\Extensions\Tools\CustomerImportance;
use App\Category;
use App\Customer;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Support\Facades\Request;

//use App\Admin\Extensions\ExcelExpoter;

class CustomerController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('고객관리');
            $content->description('리스트');

            $content->body($this->grid());
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('고객관리');
            $content->description('수정');

            $content->body($this->form()->edit($id));
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('고객관리');
            $content->description('등록');

            $content->body($this->form());
        });
    }

    protected function grid()
    {
        return Admin::grid(Customer::class, function (Grid $grid){

            $grid->model()->categoryId(Request::get('category'));
            $grid->model()->importance(Request::get('importance'));

            $grid->paginate(10);
            //$grid->id('ID')->sortable();

            $grid->category_id('그룹')->display(function($category_id) {
                return Category::find($category_id)->title;
            });



            $grid->company('회사')->sortable();
            $grid->name('성명')->sortable();
            $grid->main_phone('대표전화')->sortable();
            $grid->phone_number('휴대폰')->sortable();
            $grid->fax_number('팩스')->sortable();
            $grid->email()->sortable();
            $grid->manager('담당자')->sortable();
            $grid->zipcode('우편번호');
            $grid->column('full_name','주소')->display(function () {
                return $this->address1.' '.$this->address2;
            });
            $grid->created_at('등록일')->sortable();
            $grid->updated_at('수정일')->sortable();

            //$grid->exporter(new ExcelExpoter());
            $grid->tools(function ($tools) {
                $tools->append(new CustomerImportance());
                $tools->append(new CustomerCategory());
            });

            $grid->filter(function (Grid\Filter $filter) {

                $filter->like('company', '회사명');
                $filter->like('name', '성명');
                $filter->like('email', '이메일');
                $filter->like('manager', '담당자');


                $filter->where(function ($query) {

                    $query->where('address1', 'like', "%{$this->input}%")
                        ->orWhere('address2', 'like', "%{$this->input}%");

                }, '주소');

                $filter->equal('created_at', '등록일')->datetime();
                $filter->between('updated_at', '수정일')->datetime();

            });


        });
    }

    protected function form()
    {

        return Admin::form(Customer::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->hidden('extra_info')->attribute(['class' => 'postcodify_extra_info']);

            $form->select('category_id','그룹')->options(Category::selectOptions())->rules('required', [
                'required' => '그룹을 선택해 주세요.',
            ]);

            $form->text('name','성명')
                ->placeholder('성명을 입력해 주세요.')
                ->setWidth(2)
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

            $form->text('manager','사내담당자')
                ->placeholder('담당자명을 입력해 주세요.')
                ->setWidth(2)
                ->rules('required', [
                    'required' => '담당자명을 입력해 주세요.',
                ]);

            $form->radio('importance','고객 중요도')->options([
                1 => '상',
                2 => '중',
                3 => '하',
            ])->stacked();

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
