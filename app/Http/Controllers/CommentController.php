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
        $list_Comment = Comment::with('reProduct', 'reCustomer')
            ->orderBy('status', 'DESC')
            ->get();

        return view('admin.pages.comment.index')->with(compact('title', 'list_Comment'));
    }

    public function allow_comment(Request $request)
    {
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->status = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->title = $data['comment'];
        $comment->product_id = $data['comment_product_id'];
        $comment->comment_parent_id = $data['comment_id'];
        $comment->status = 0;
        $comment->admin_id = 1;
        $comment->save();
    }

    //user
    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::with('reCustomer')
            ->where('status', 0)
            ->where('admin_id',NULL)
            ->where('product_id', $product_id)->get();

        $comment_reply = Comment::with('reAdmin')
            ->where('status', 0)
            ->where('customer_id',NULL)
            ->where('product_id', $product_id)->get();

        $output = '';
        foreach ($comment as $comm) {
            $output .= '
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: green">@' . $comm->reCustomer->fullname . '<span style="float:right; font-size: 13px">'.$comm->created_at.'</span></h5>
                                <p class="card-text">' . $comm->title . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> ';

            foreach ($comment_reply as $comm_rep){
                if ($comm_rep->comment_parent_id == $comm->id){
                    $output .= '
                    <div class="ms-5 mt-2">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title" style="color: green">@Admin<span style="float:right; font-size: 13px">'.$comm->created_at.'</span></h5>
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

    public function send_comment(Request $request)
    {
        $product_id = $request->product_id;
        $customer_id = $request->customer_id;
        $title = $request->title;

        $comment = new Comment();
        $comment->title = $title;
        $comment->customer_id = $customer_id;
        $comment->product_id = $product_id;
        $comment->status = 1;
        $comment->save();
    }
}
