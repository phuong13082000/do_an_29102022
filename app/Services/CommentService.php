<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function showCommmentDetail($request)
    {
        $productId = $request['product_id'];

        $comments = Comment::with('reCustomer')
            ->where('status', 0)
            ->where('admin_id', NULL)
            ->where('product_id', $productId)
            ->get();

        $commentReplies = Comment::with('reAdmin')
            ->where('status', 0)
            ->where('customer_id', NULL)
            ->where('product_id', $productId)
            ->get();

        $output = '';
        foreach ($comments as $comment) {
            $output .= '
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: green">@' . $comment->reCustomer->fullname . '<span style="float:right; font-size: 13px">' . $comment->created_at . '</span></h5>
                                <p class="card-text">' . $comment->title . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> ';
            foreach ($commentReplies as $commentReply) {
                if ($commentReply->comment_parent_id == $comment->id) {
                    $output .= '
            <div class="ms-5 mt-2">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: green">@Admin<span style="float:right; font-size: 13px">' . $comment->created_at . '</span></h5>
                                <p class="card-text">' . $commentReply->title . '</p >
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

    public function allowComment($request)
    {
        $comment = Comment::find($request['comment_id']);
        $comment->status = $request['comment_status'];
        $comment->save();
    }

    public function sendComment($request)
    {
        $comment = new Comment();
        $comment->title = $request['title'];
        $comment->customer_id = $request['customer_id'];
        $comment->product_id = $request['product_id'];
        $comment->status = 1;
        $comment->save();
    }

    public function replyComment($request)
    {
        $comment = new Comment();
        $comment->title = $request['comment'];
        $comment->product_id = $request['comment_product_id'];
        $comment->comment_parent_id = $request['comment_id'];
        $comment->status = 0;
        $comment->admin_id = 1;
        $comment->save();
    }

    public function deleteComment($request)
    {
        $comment_parent = Comment::where('comment_parent_id', $request['comment_id'])->get();
        foreach ($comment_parent as $parrent) {
            $parrent->delete();
        }
        $comments = Comment::find($request['comment_id']);
        $comments->delete();
    }

    public function deleteReplyComment($request)
    {
        $comments = Comment::find($request['comment_parent_id']);
        $comments->delete();
    }
}
