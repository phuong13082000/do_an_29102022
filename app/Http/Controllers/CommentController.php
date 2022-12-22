<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService, $commentRepository;

    public function __construct(CommentRepository $commentRepository, CommentService $commentService)
    {
        $this->commentRepository = $commentRepository;
        $this->commentService = $commentService;
    }

    //admin
    public function show_comment()
    {
        $title = 'Comment';
        $list_Comment = $this->commentRepository->getAll();
        $count_message = $this->commentRepository->countComment();
        $messages = $this->commentRepository->getMessage();
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
