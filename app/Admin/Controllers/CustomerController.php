<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\action\CheckRow;
use App\Admin\Extensions\ExcelExpoter;
use App\Admin\Extensions\search\CustomerList;
use App\Admin\Extensions\Tools\CustomerImportance;
use App\Category;
use App\Customer;
use App\Sale;
use Encore\Admin\Controllers\Search;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\DB;
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

            $content->row(function (Row $row) {

                $row->column(12, function (Column $column) {
                    $column->append(CustomerList::search());
                });

            });

            $content->body($this->grid());

        });
    }

    public function detail($customerId)
    {
        $customer = Customer::find($customerId);
        $category_customer = Category::find($customer->category_customer_id);
        $category_sales = Category::find($customer->category_sales_id);
        $category_delivery = Category::find($customer->category_delivery_id);
        $sales = Sale::where('customer_id', $customerId)->get();
        $salesResultPrice = Sale::where('customer_id', $customerId)->sum('price');

        $noSalesResultPrice = Sale::where('customer_id', $customerId)->sum('noCollectPrice');
        $collectResultPrice = Sale::where('customer_id', $customerId)->sum('collectPriceAll');

        return view('admin.customers.detail', [
            'customer' => $customer,
            'category_customer' => $category_customer,
            'category_sales' => $category_sales,
            'category_delivery' => $category_delivery,
            'sales' => $sales,
            'salesResultPrice' => $salesResultPrice,
            'noSalesResultPrice' => $noSalesResultPrice,
            'collectResultPrice' => $collectResultPrice,
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

        if (isset($_REQUEST['customerId'])) {

            return Admin::grid(Sale::class, function (Grid $grid) {

                $grid->model()->customerId(Request::get('customerId'));

                //$grid->id('id');
                $grid->customer()->company('회사명')->sortable();
                $grid->customer()->manager('영업담당자')->sortable();

                $grid->placeOfDelivery('매출건명');
                $grid->price('매출금액')->display(function ($price) {
                    return number_format($price);
                });
                $grid->collectPriceAll('수금액')->display(function ($collectPriceAll) {
                    return number_format($collectPriceAll);
                });
                $grid->noCollectPrice('미수금')->display(function ($noCollectPrice) {
                    return number_format($noCollectPrice);
                });

                $grid->created_at('등록일')->sortable();

                $grid->filter(function (Grid\Filter $filter) {
                    $filter->between('created_at', '등록일')->datetime();
                });


            });

        } else {

            return Admin::grid(Customer::class, function (Grid $grid) {

                //$grid->model()->userId(Admin::user());

                $grid->model()->orderBy('id', 'desc');
                $grid->paginate(20);

                $grid->model()->categoryCustomerId(Request::get('categoryCustomer'));
                $grid->model()->categorySalesId(Request::get('categorySales'));
                $grid->model()->categoryDeliveryId(Request::get('categoryDelivery'));
                $grid->model()->importance(Request::get('importance'));


                $grid->category_customer_id('고객사분류')->display(function ($category_customer_id) {
                    if ($category_customer_id) {
                        return Category::find($category_customer_id)->title;
                    } else {
                        return '';
                    }
                });

                $grid->category_sales_id('영업분류')->display(function ($category_sales_id) {
                    if ($category_sales_id) {
                        return Category::find($category_sales_id)->title;
                    } else {
                        return '';
                    }
                });

                $grid->category_delivery_id('납품분류')->display(function ($category_delivery_id) {
                    if ($category_delivery_id) {
                        return Category::find($category_delivery_id)->title;
                    } else {
                        return '';
                    }
                });

                $grid->manager('영업담당자')->sortable();

                $grid->importance('고객중요도')->display(function ($importance) {
                    $html = "<i class='fa fa-star' style='color:#ff8913'></i>";

                    return join('&nbsp;', array_fill(0, min(5, $importance), $html));
                })->sortable();

                $grid->company('회사명')->sortable();
                $grid->name('성명')->sortable();


                $grid->actions(function ($actions) {

//                if (!Admin::user()->can('admin.customer.update') || Admin::user()->id != $actions->row['user_id']) {
//                    $actions->disableDelete();
//                }

                    $actions->disableDelete();
                    $actions->disableEdit();
                    $actions->append(new CheckRow($actions->getKey()));

                });


                $grid->sales('매출금 / 총수금액 / 총미수금')->display(function ($sales) {
                    $result_price = 0;
                    $result_CollectPriceAll = 0;
                    $result_noCollectPrice = 0;
                    foreach ($sales as $key => $sale) {
                        $result_price += $sale['price'];
                        $result_CollectPriceAll += $sale['collectPriceAll'];
                        $result_noCollectPrice += $sale['noCollectPrice'];
                    }
                    $result_price = number_format($result_price);
                    $result_CollectPriceAll = number_format($result_CollectPriceAll);
                    $result_noCollectPrice = number_format($result_noCollectPrice);

                    if ($result_price > 0 || $result_CollectPriceAll > 0 || $result_noCollectPrice > 0) {
                        return "<font color='blue'>" . $result_price . "</font> / " . "<font color='green'>" . $result_CollectPriceAll . "</font>" . "/ <font color='red'>" . $result_noCollectPrice . "</font>";

                    } else {
                        return '';
                    }


                });

                $grid->created_at('등록일')->sortable();
                $grid->tools(function ($tools) {

                    $tools->append(new CustomerImportance());
                    //$tools->append(new CustomerCategory());
                });

                $grid->filter(function (Grid\Filter $filter) {
                    $filter->equal('category_customer_id', '고객분류')->select(Category::selectOptionsIns(1));
                    //$filter->equal('category_sales_id', '영업분류')->select(Category::selectOptionsIns(2));
                    //$filter->equal('category_delivery_id', '납품분류')->select(Category::selectOptionsIns(3));
                    $filter->like('company', '회사명');
                    $filter->like('name', '고객명');
                    //$filter->like('email', '이메일');
                    $filter->like('manager', '담당자');
                    $filter->like('phone_number', '휴대폰');

                    $filter->like('address1', '주소');


//                    $filter->where(function ($query) {
//
//                        $query->where('address1', 'like', "%{$_REQUEST['address']}%")
//                            ->orWhere('address2', 'like', "%{$_REQUEST['address']}%");
//
//                    }, '주소');

                    $filter->between('created_at', '등록일')->datetime();


                    $filter->where(function ($query) {

                        $query->whereHas('sales', function ($query) {
                            $query->where('noCollectPrice', '>', 0);
                        });

                    }, 'sales');


                });

                $grid->exporter(new ExcelExpoter());

            });
        }
    }

    protected function form()
    {

        return Admin::form(Customer::class, function (Form $form) {

            $form->tab('기본정보', function (Form $form) {

                $form->hidden('extra_info')->attribute(['class' => 'postcodify_extra_info'])->rules('nullable');
                $form->hidden('user_id')->value(Admin::user()->id);
                $form->hidden('m_id')->value(Admin::user()->id);

                $form->select('category_customer_id', '고객사분류')->options(Category::selectOptionsIns(1))->rules('required', [
                    'required' => '그룹을 선택해 주세요.',
                ]);

//            $form->select('category_customer_id', '고객사분류')->options(
//                Category::parentId()->pluck('title', 'id')
//            )->setWidth(2);

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

                if (Admin::user()->can('admin.customers.discount')) {
                    $form->currency('discountRateManufacturing', '제조할인율')
                        ->symbol('%')
                        ->setWidth(3);
                    $form->currency('discountRateDistribution', '유통할인율')
                        ->symbol('%')
                        ->setWidth(3);
                } else {
                    $form->currency('discountRateManufacturing', '제조할인율')
                        ->symbol('%')
                        ->readOnly()
                        ->setWidth(3);
                    $form->currency('discountRateDistribution', '유통할인율')
                        ->symbol('%')
                        ->readOnly()
                        ->setWidth(3);
                }


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
                    ->setWidth('2')
                    ->placeholder('직급')
                    ->rules('nullable');

                $form->text('main_phone', '대표전화')
                    ->setWidth('2')
                    ->placeholder('대표전화')
                    ->rules('nullable');

                $form->mobile('phone_number', '휴대폰')
                    ->placeholder('휴대폰')
                    ->options(['mask' => '999 9999 9999'])->rules('nullable');

                $form->text('fax_number', '팩스')
                    ->setWidth('2')
                    ->placeholder('팩스')
                    ->rules('nullable');

                $form->email('email', '이메일')
                    ->setWidth('5')
                    ->placeholder('이메일을 입력해 주세요.')->rules('nullable');

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


//                if (!Admin::user()->can('admin.customer.update')) {
//                    $form->disableSubmit();
//                }


            })->tab('매출정보', function (Form $form) {

                $form->hasMany('sales', '매출정보입력', function (Form\NestedForm $form) {

                    $form->hidden('user_id')->value(Admin::user()->id);
                    $form->text('placeOfDelivery', '매출건명')
                        ->placeholder('매출건명을 입력해 주세요.');
                    $form->currency('price', '매출금액')
                        ->symbol('₩')
                        ->placeholder('매출금액을 입력해 주세요.');
                    $form->datetime('sales_at', '매출발생일자')
                        ->placeholder('날짜입력');

                    $states = [
                        'on' => ['value' => 2, 'text' => 'YES', 'color' => 'success'],
                        'off' => ['value' => 1, 'text' => 'NO', 'color' => 'default'],
                    ];

                    $form->switch('tax', '세금계산서 발행여부')->states($states)->default(1);

                    $form->file('attach_sales_file', '첨부파일');

                    $form->divider();

                    $form->currency('collectPrice1', '수금액(1차)')
                        ->symbol('₩');
                    $form->datetime('collectPrice1_date', '수금액(1차) 처리일자')
                        ->placeholder('날짜입력');

                    $form->divider();

                    $form->currency('collectPrice2', '수금액(2차)')
                        ->symbol('₩');
                    $form->datetime('collectPrice2_date', '수금액(2차) 처리일자')
                        ->placeholder('날짜입력');

                    $form->divider();

                    $form->currency('collectPrice3', '수금액(3차)')
                        ->symbol('₩');
                    $form->datetime('collectPrice3_date', '수금액(3차) 처리일자')
                        ->placeholder('날짜입력');

                    $form->divider();

                    $form->currency('collectPriceAll', ' 총 수금액')
                        ->symbol('₩')
                        ->placeholder('0')
                        ->value('0');

                    $form->currency('noCollectPrice', '미수금액')
                        ->symbol('₩')
                        ->placeholder('0')
                        ->value('0');
                });
            });

        });
    }

    public function destroy($id)
    {
        if ($this->form()->destroy($id)) {

            $deletedRows = Sale::where('customer_id', $id)->delete();
            if ($deletedRows) {
                return response()->json([
                    'status' => true,
                    'message' => trans('admin.delete_succeeded'),
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => trans('admin.delete_failed'),
                ]);
            }

        } else {
            return response()->json([
                'status' => false,
                'message' => trans('admin.delete_failed'),
            ]);
        }
    }

    public function store()
    {

        return $this->form()->store();
    }

    public function update($id)
    {
        return $this->form()->update($id);
    }

}