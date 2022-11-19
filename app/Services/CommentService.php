<?php

namespace App\Services;

use App\Models\Comment;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentService
{
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function showCommmentDetail(Request $request)
    {
        $product_id = $request->product_id;

        $comment = $this->commentRepository->getCommentIndex($product_id);
        $comment_reply = $this->commentRepository->getCommentParrentIndex($product_id);

        $output = '';
        foreach ($comment as $comm) {
            $output .= '
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: green">@' . $comm->reCustomer->fullname . '<span style="float:right; font-size: 13px">' . $comm->created_at . '</span></h5>
                                <p class="card-text">' . $comm->title . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> ';

            foreach ($comment_reply as $comm_rep) {
                if ($comm_rep->comment_parent_id == $comm->id) {
                    $output .= '
            <div class="ms-5 mt-2">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: green">@Admin<span style="float:right; font-size: 13px">' . $comm->created_at . '</span></h5>
                                <p class="card-text">' . $comm_rep->title . '</p >
                            </div >
                        </div>
                    </div>
                </div>
            </div >';
                }
            }
        }
        echo $output;
    }

    public function allowComment(Request $request)
    {
        $comment = $this->commentRepository->findID($request['comment_id']);
        $comment->status = $request['comment_status'];
        $comment->save();
    }

    public function sendComment(Request $request)
    {
        $comment = new Comment();
        $comment->title = $request['title'];
        $comment->customer_id = $request['customer_id'];
        $comment->product_id = $request['product_id'];
        $comment->status = 1;
        $comment->save();
    }

    public function replyComment(Request $request)
    {
        $comment = new Comment();
        $comment->title = $request['comment'];
        $comment->product_id = $request['comment_product_id'];
        $comment->comment_parent_id = $request['comment_id'];
        $comment->status = 0;
        $comment->admin_id = 1;
        $comment->save();
    }

    public function deleteComment(Request $request)
    {
        $comment_parent = $this->commentRepository->commentParrent($request['comment_id']);
        foreach ($comment_parent as $parrent) {
            $parrent->delete();
        }
        $comments = $this->commentRepository->findID($request['comment_id']);
        $comments->delete();
    }

    public function deleteReplyComment(Request $request)
    {
        $comments = $this->commentRepository->findID($request['comment_parent_id']);
        $comments->delete();
    }
}
