<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function show_comment()
    {
        $title = 'Comment';
        $list_Comment = Comment::with('reProduct', 'reCustomer')
            ->orderBy('created_at','DESC')
            ->get();

        return view('admin.pages.comment.index')->with(compact('title', 'list_Comment'));
    }
}
