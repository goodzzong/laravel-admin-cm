<?php

namespace App\Admin\Controllers;

use App\Business;
use App\Comment;
use App\Free;
use App\Http\Requests\CommentsRequest;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Facades\Admin;

class CommentsController extends Controller
{
    use ModelForm;

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function update(CommentsRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        $routeUrl = $comment->commentable_type == "App\Business" ? "business.show" : "free.show";

        return redirect(route($routeUrl, $comment->commentable->id) . '#comment_' . $comment->id);
    }

    public function destroy(Comment $comment)
    {
        if ($comment->replies()->count() > 0) {
            $comment->delete();
        } else {
            $comment->forceDelete();
        }

        return response()->json([], 204);
    }

    public function store(CommentsRequest $request, $id)
    {

        if ($request->modelName == 'business') {
            $comment = Business::find($id)->comments()->create(array_merge(
                $request->all(),
                ['user_id' => Admin::user()->id]
            ));
        } else {
            $comment = Free::find($id)->comments()->create(array_merge(
                $request->all(),
                ['user_id' => Admin::user()->id]
            ));
        }

        $routeUrl = $comment->commentable_type == "App\Business" ? "business.show" : "free.show";

        return redirect(route($routeUrl, $id) . '#comment_' . $comment->id);
    }


}
