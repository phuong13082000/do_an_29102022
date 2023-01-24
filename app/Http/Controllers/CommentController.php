<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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
        $comment = Comment::find($request['comment_id']);
        $comment->status = $request['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request)
    {
        $comment = new Comment();
        $comment->title = $request['comment'];
        $comment->product_id = $request['comment_product_id'];
        $comment->comment_parent_id = $request['comment_id'];
        $comment->status = 0;
        $comment->admin_id = 1;
        $comment->save();
    }

    public function delete_comment(Request $request)
    {
        $comment_parent = Comment::where('comment_parent_id', $request['comment_id'])->get();
        foreach ($comment_parent as $parrent) {
            $parrent->delete();
        }
        $comments = Comment::find($request['comment_id']);
        $comments->delete();
    }

    public function delete_reply_comment(Request $request)
    {
        $comments = Comment::find($request['comment_parent_id']);
        $comments->delete();
    }

    //user
    public function load_comment(Request $request)
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

    public function send_comment(Request $request)
    {
        $comment = new Comment();
        $comment->title = $request['title'];
        $comment->customer_id = $request['customer_id'];
        $comment->product_id = $request['product_id'];
        $comment->status = 1;
        $comment->save();
    }
}
