<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //admin
    public function allow_comment(Request $request)
    {
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->status = $data['comment_status'];
        $comment->save();
    }

    public function show_comment()
    {
        $title = 'Comment';
        $list_Comment = Comment::with('reProduct', 'reCustomer')
            ->orderBy('status', 'DESC')
            ->get();

        return view('admin.pages.comment.index')->with(compact('title', 'list_Comment'));
    }

    //user
    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::with('reCustomer', 'reAdmin')
            ->where('status', 0)
            ->where('product_id', $product_id)->get();
        $output = '';
        foreach ($comment as $comm) {
            $output .= '
            <div class="mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: green">@' . $comm->reCustomer->fullname . '</h5>
                                <p class="card-text">' . $comm->title . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> ';
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
