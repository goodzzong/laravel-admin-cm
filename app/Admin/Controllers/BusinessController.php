<?php

namespace App\Admin\Controllers;

use App\Business;

use Encore\Admin\Auth\Database\Administrator;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class BusinessController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('영업보고게시판');
            $content->description('리스트');

            //$content->body($this->grid());

            $businessList = Business::latest()->paginate(10);

            $content->body(
                view('admin.business.list', compact('businessList'))
            );
        });
    }

    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('영업보고게시판');
            $content->description('수정');

            $content->body($this->form()->edit($id));
        });
    }

    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('영업보고게시판');
            $content->description('등록');

            $content->body($this->form());
//            $content->body(
//              view('admin.business.create')
//            );
        });
    }

    public function show(Business $business)
    {


        return Admin::content(function (Content $content) use ($business) {

            $user = Admin::user();

            $modelName = "business";
            $model = $business;
            $comments = $business->comments()
                ->with('replies')
                ->withTrashed()
                ->whereNull('parent_id')
                ->latest()
                ->get();

            $content->header('영업보고게시판');
            $content->description('보기');
            //$content->body($this->view()->view($id));
            $content->body(
                view('admin.business.show', compact('model', 'user', 'comments', 'modelName'))
            );
        });

    }

    protected function grid()
    {
        return Admin::grid(Business::class, function (Grid $grid) {

            $grid->model()->ordered();
            $grid->id('ID')->sortable();

            $grid->title('제목')->ucfirst()->limit(50);
            $grid->content('내용')->ucfirst()->limit(50);

            $grid->created_at('등록일');


            $grid->filter(function (Grid\Filter $filter) {

                $filter->like('title', '제목');
                $filter->equal('created_at', '등록일')->datetime();
                $filter->between('updated_at', '수정일')->datetime();

            });

        });
    }

    protected function form()
    {
        return Admin::form(Business::class, function (Form $form) {

            $form->hidden('user_id')->value(Admin::user()->id);
            $form->hidden('rank')->value(Business::count());

            //$form->display('id', 'ID');

            $form->text('title', '제목')->rules('required', [
                'required' => '제목을 입력해 주세요.',
            ])->placeholder('제목을 입력해 주세요.');

            //$form->ckeditor('content');
            $form->editor('content', '내용');

//            $form->textarea('content', '내용')->rules('required', [
//                'required' => '내용을 입력해 주세요.',
//            ]);

//            $form->file('attachFile', '첨부파일')->removable();
//
//            $states = [
//                'on' => ['value' => 1, 'text' => 'YES', 'color' => 'success'],
//                'off' => ['value' => 2, 'text' => 'NO', 'color' => 'default'],
//            ];

//            $form->switch('released', '공개여부')->states($states)->default(1);
            $form->display('created_at', '등록일');
            // $form->display('updated_at', '수정일');

        });
    }


    protected function view()
    {
        return Admin::form(Business::class, function (Form $form) {

            $form->hidden('user_id')->value(Admin::user()->id);
            $form->hidden('rank')->value(Business::count());

            //$form->display('id', 'ID');

            $form->display('title', '제목');

            //$form->ckeditor('content');
            $form->display('content', '내용');
//            $form->textarea('content', '내용')->rules('required', [
//                'required' => '내용을 입력해 주세요.',
//            ]);
//            $form->file('attachFile', '첨부파일');

            $form->display('created_at', '등록일');
            //$form->display('updated_at', '수정일');
        });
    }
}
