<?php

namespace App\Admin\Controllers;

use App\Business;
use App\Comment;
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

        return redirect(route('business.show', $comment->commentable->id) . '#comment_' . $comment->id);
    }

    public function destroy(Comment $comment)
    {
        if($comment->replies()->count() > 0) {
            $comment->delete();
        } else {
            $comment->forceDelete();
        }

        return response()->json([], 204);
    }

    public function store(CommentsRequest $request, Business $business)
    {

        $comment = $business->comments()->create(array_merge(
            $request->all(),
            [ 'user_id' => Admin::user()->id ]
        ));

        return redirect(route('business.show', $business->id) . '#comment_' . $comment->id);
    }
}
