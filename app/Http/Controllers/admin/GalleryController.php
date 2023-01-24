<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallery_index($id)
    {
        $title = 'Gallery';

        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');

        $product_id = $id;

        return view('admin.pages.product.gallery')->with(compact('title', 'list_brand', 'list_category', 'count_message', 'messages', 'product_id'));
    }

    public function select_gallery(Request $request)
    {
        $productId = $request['pro_id'];
        $galleries = Gallery::where('product_id', $productId)->get();
        $galleryCount = $galleries->count();

        $output = '<form>
                   ' . csrf_field() . '
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>';
        if ($galleryCount > 0) {
            $i = 0;
            foreach ($galleries as $gallery) {
                $i++;
                $output .= '<tr>
                                <td>' . $i . '</td>
                                <td contenteditable class="edit_gall_name" data-gall_id="' . $gallery->id . '">' . $gallery->title . '</td>
                                <td>
                                    <img src="' . url('uploads/gallery/' . $gallery->image) . '" alt="' . $gallery->title . '" class="img-thumbnail" width="120" height="120">
                                    <input type="file" class="file_image" style="width: 40%" data-gall_id="' . $gallery->id . '" id="file-' . $gallery->id . '" name="file" accept="image/*">
                                </td>
                                <td><button type="button" class="delete_gall" data-gall_id="' . $gallery->id . '" class="btn btn-xs btn-danger">Delete</button></td>
                             </tr>';
            }
        } else {
            $output .= '<tr>
                            <td colspan="4">Chưa có thư viện ảnh</td>
                      </tr>';
        }
        $output .= '</tbody>
                 </table>
               </form>';

        echo $output;
    }

    public function insert_gallery(Request $request, $id)
    {
        $get_image = $request->file('file');

        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $image->getClientOriginalExtension();
                $image->move('../public/uploads/gallery/', $new_image);

                $gallery = new Gallery();
                $gallery->title = $new_image;
                $gallery->image = $new_image;
                $gallery->product_id = $id;
                $gallery->save();
            }
        }
        return redirect()->back();
    }

    public function update_gallery_name(Request $request)
    {
        $gallery = Gallery::find($request['gall_id']);
        $gallery->title = $request['gall_text'];
        $gallery->save();
    }

    public function update_gallery(Request $request)
    {
        $get_image = $request->file('file');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('../public/uploads/gallery/', $new_image);

            $gallery = Gallery::find($request['gall_id']);
            unlink('../public/uploads/gallery/' . $gallery->title);

            $gallery->title = $new_image;
            $gallery->image = $new_image;
            $gallery->save();
        }
    }

    public function delete_gallery(Request $request)
    {
        $gallery = Gallery::find($request['gall_id']);
        unlink('../public/uploads/gallery/' . $gallery->title);
        $gallery->delete();
    }
}
