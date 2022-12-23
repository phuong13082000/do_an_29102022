<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    //admin
    public function show_comment()
    {
        $title = 'Comment';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $list_Comment = Comment::with('reProduct', 'reCustomer')->orderBy('status', 'DESC')->get();

        return view('admin.pages.comment.index')->with(compact('title', 'list_Comment', 'count_message', 'messages'));
    }

    public function allow_comment(Request $request)
    {
        $this->commentService->allowComment($request);
    }

    public function reply_comment(Request $request)
    {
        $this->commentService->replyComment($request);
    }

    public function delete_comment(Request $request)
    {
        $this->commentService->deleteComment($request);
    }

    public function delete_reply_comment(Request $request)
    {
        $this->commentService->deleteReplyComment($request);
    }

    //user
    public function load_comment(Request $request)
    {
        $this->commentService->showCommmentDetail($request);
    }

    public function send_comment(Request $request)
    {
        $this->commentService->sendComment($request);
    }
}
