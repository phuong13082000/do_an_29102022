<?php

namespace App\Repositories;


use App\Models\Comment;

class CommentRepository
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getAll()
    {
        return Comment::with('reProduct', 'reCustomer')->orderBy('status', 'DESC')->get();
    }

    public function findID($id)
    {
        return Comment::find($id);
    }

    public function countComment()
    {
        return Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
    }

    public function getMessage()
    {
        return Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();
    }

    public function create($attributes)
    {
        return $this->comment->create($attributes);
    }

    public function commentParrent($id)
    {
        return Comment::where('comment_parent_id', $id)->get();
    }

    public function getCommentIndex($product_id)
    {
        return Comment::with('reCustomer')->where('status', 0)->where('admin_id', NULL)->where('product_id', $product_id)->get();
    }

    public function getCommentParrentIndex($product_id)
    {
        return Comment::with('reAdmin')->where('status', 0)->where('customer_id', NULL)->where('product_id', $product_id)->get();
    }

    public function findCommentByProductId($id)
    {
        return Comment::where('product_id', $id)->get();
    }
}
