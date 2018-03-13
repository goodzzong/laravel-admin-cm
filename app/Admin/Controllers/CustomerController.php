<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\action\CheckRow;
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

        //echo Admin::user();

        return Admin::content(function (Content $content) {

            $content->header('고객관리');
            $content->description('리스트');

            $content->body($this->grid());
        });
    }

    public function detail($customerId)
    {
        $customer = \App\Customer::find($customerId);
        $category_customer = Category::find($customer->category_customer_id);
        $category_sales = Category::find($customer->category_sales_id);
        $category_delivery = Category::find($customer->category_delivery_id);
        return view('admin::customer.detail', [
            'customer' => $customer,
            'category_customer' => $category_customer,
            'category_sales' => $category_sales,
            'category_delivery' => $category_delivery
        ]);
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

        return Admin::grid(Customer::class, function (Grid $grid) {

            //$grid->model()->userId(Admin::user());
            $grid->model()->categoryId(Request::get('category'));
            $grid->model()->importance(Request::get('importance'));

            $grid->paginate(10);
            //$grid->id('ID')->sortable();

            $grid->category_customer_id('고객사분류')->display(function ($category_customer_id) {
                return Category::find($category_customer_id)->title;
            });

            $grid->category_sales_id('영업분류')->display(function ($category_sales_id) {
                return Category::find($category_sales_id)->title;
            });

            $grid->category_delivery_id('납품분류')->display(function ($category_delivery_id) {
                return Category::find($category_delivery_id)->title;
            });

            $grid->manager('영업담당자')->sortable();

            $grid->importance('고객중요도')->display(function ($importance) {
                $html = "<i class='fa fa-star' style='color:#ff8913'></i>";

                return join('&nbsp;', array_fill(0, min(5, $importance), $html));
            })->sortable();

            $grid->company('회사명')->sortable();
            $grid->name('성명')->sortable();
            $grid->main_phone('대표전화')->sortable();
//            $grid->phone_number('휴대폰')->sortable();
//            $grid->fax_number('팩스')->sortable();

            $grid->email()->sortable();


            $grid->actions(function ($actions) {

//                if (!Admin::user()->can('admin.customer.update') || Admin::user()->id != $actions->row['user_id']) {
//                    $actions->disableDelete();
//                }
                $actions->disableDelete();
                $actions->append(new CheckRow($actions->getKey()));

            });

//            $grid->zipcode('우편번호');
//            $grid->column('full_name', '주소')->display(function () {
//                return $this->address1 . ' ' . $this->address2;
//            });
            $grid->created_at('등록일')->sortable();
//            $grid->updated_at('수정일')->sortable();


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

                $filter->between('created_at', '등록일')->datetime();
//                $filter->between('updated_at', '수정일')->datetime();

            });


            //$grid->exporter(new ExcelExpoter());

        });
    }


    protected function form()
    {

        return Admin::form(Customer::class, function (Form $form) {

            //$form->display('id', 'ID');
            $form->hidden('extra_info')->attribute(['class' => 'postcodify_extra_info'])->rules('nullable');
            $form->hidden('user_id')->value(Admin::user()->id);

            $form->select('category_customer_id', '고객사분류')->options(Category::selectOptionsIns(1))->rules('required', [
                'required' => '그룹을 선택해 주세요.',
            ]);
            /*
            $form->select('category_customer_id', '고객사분류')->options(
                Category::parentId()->pluck('title', 'id')
            )->setWidth(2);*/


            $form->select('category_sales_id', '영업분류')->options(Category::selectOptionsIns(2))->rules('required', [
                'required' => '그룹을 선택해 주세요.',
            ]);

            $form->select('category_delivery_id', '납품분류')->options(Category::selectOptionsIns(3))->rules('required', [
                'required' => '그룹을 선택해 주세요.',
            ]);

            $form->text('manager', '영업담당자')
                ->placeholder('담당자명을 입력해 주세요.')
                ->setWidth(2)
                ->rules('required', [
                    'required' => '담당자명을 입력해 주세요.',
                ]);

            $form->radio('importance', '고객 중요도')->options([
                1 => '★',
                2 => '★★',
                3 => '★★★',
                4 => '★★★★',
                5 => '★★★★★',
            ])->stacked()->rules('nullable');

            $form->divide();


            $form->text('company', '회사')
                ->placeholder('회사명을 입력해 주세요.')
                ->setWidth(5)->rules('nullable');

            $form->text('name', '성명')
                ->placeholder('성명을 입력해 주세요.')
                ->setWidth(2)
                ->rules('required', [
                    'required' => '성명을 입력해 주세요.',
                ]);

            $form->text('rank', '직급')
                ->placeholder('직급을 입력해 주세요.')
                ->setWidth(5)->rules('nullable');


            $form->mobile('main_phone', '대표전화')
                ->placeholder('대표전화')
                ->rules('nullable');
            $form->mobile('phone_number', '휴대폰')
                ->placeholder('휴대폰')
                ->options(['mask' => '999 9999 9999'])->rules('nullable');
            $form->mobile('fax_number', '팩스')
                ->placeholder('팩스')
                ->rules('nullable');

            $form->email('email', '이메일')
                ->setWidth('5')
                ->placeholder('이메일을 입력해 주세요.')
                ->rules('required|email', [
                    'required' => '이메일을 입력해 주세요.',
                    'email' => '이메일 형식으로 입력해 주세요.',
                ]);

            $form->address('zipcode', '우편번호')
                ->setWidth('2')
                ->placeholder('우편번호')
                ->attribute(['class' => 'postcodify_postcode5 form-control'])->rules('nullable');

            $form->text('address1', '주소')
                ->placeholder('주소')
                ->attribute(['class' => 'postcodify_address form-control'])->rules('nullable');

            $form->text('address2', '상세주소')
                ->placeholder('상세주소를 입력해 주세요.')
                ->attribute(['class' => 'postcodify_details form-control'])->rules('nullable');


            $form->divide();


            $form->textarea('contents', '특이사항')
                ->placeholder('특이사항을 입력해 주세요.')->rules('nullable');

            $form->image('picture', '명함이미지')->removable()->rules('nullable');

            $form->multipleFile('attach_files', '첨부파일')->rules('nullable')->removable();

//            $form->display('created_at', '등록일');
//            $form->display('updated_at', '수정일');
        });

    }

}