<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Product';
        $list_Product = Product::with('reBrand', 'reCategory')->get();
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.product.index')->with(compact('title', 'list_Product', 'count_message', 'messages'));
    }

    public function create()
    {
        $title = 'Create Product';
        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.product.form')->with(compact('title', 'list_brand', 'list_category', 'count_message', 'messages'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $product = new Product();
        $product->title = $data['title'];
        $product->number = $data['number'];
        $product->price = $data['price'];
        $product->price_sale = $data['price_sale'];
        $product->manhinh = $data['manhinh'];
        $product->mausac = $data['mausac'];
        $product->camera_sau = $data['camera_sau'];
        $product->camera_truoc = $data['camera_truoc'];
        $product->cpu = $data['cpu'];
        $product->bonho = $data['bonho'];
        $product->ram = $data['ram'];
        $product->ketnoi = $data['ketnoi'];
        $product->pin_sac = $data['pin_sac'];
        $product->tienich = $data['tienich'];
        $product->thongtin_chung = $data['thongtin_chung'];
        $product->status = $data['status'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];

        $get_image = $request->file('image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product/', $new_image);
            $product->image = $new_image;
        }

        $product->save();

        return redirect()->route('product.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = 'Edit Product';
        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        $product = Product::find($id);

        return view('admin.pages.product.form')->with(compact('title', 'product', 'list_brand', 'list_category', 'count_message', 'messages'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $product = Product::find($id);
        $product->title = $data['title'];
        $product->number = $data['number'];
        $product->price = $data['price'];
        $product->price_sale = $data['price_sale'];
        $product->manhinh = $data['manhinh'];
        $product->mausac = $data['mausac'];
        $product->camera_sau = $data['camera_sau'];
        $product->camera_truoc = $data['camera_truoc'];
        $product->cpu = $data['cpu'];
        $product->bonho = $data['bonho'];
        $product->ram = $data['ram'];
        $product->ketnoi = $data['ketnoi'];
        $product->pin_sac = $data['pin_sac'];
        $product->tienich = $data['tienich'];
        $product->thongtin_chung = $data['thongtin_chung'];
        $product->status = $data['status'];
        $product->brand_id = $data['brand_id'];
        $product->category_id = $data['category_id'];

        $get_image = $request->file('image');
        if ($get_image) {
            if (file_exists('public/uploads/product/' . $product->image)) {
                unlink('public/uploads/product/' . $product->image);
            } else {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/product/', $new_image);
                $product->image = $new_image;
            }
        }

        $product->save();

        return redirect()->route('product.index');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if (file_exists('public/uploads/product/' . $product->image)) {
            unlink('public/uploads/product/' . $product->image);
        }

        $product->delete();
        return redirect()->route('product.index');
    }

    public function gallery_index($id)
    {
        $title = 'Gallery';
        $list_brand = Brand::pluck('title', 'id');
        $list_category = Category::pluck('title', 'id');
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        $product_id = $id;

        return view('admin.pages.product.gallery')->with(compact('title', 'list_brand', 'list_category', 'count_message', 'messages', 'product_id'));
    }

    public function select_gallery(Request $request)
    {
        $product_id = $request['pro_id'];
        $gallery = Gallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();
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
        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $gall) {
                $i++;
                $output .= '<tr>
                                <td>' . $i . '</td>
                                <td contenteditable class="edit_gall_name" data-gall_id="' . $gall->id . '">' . $gall->title . '</td>
                                <td>
                                    <img src="' . url('uploads/gallery/' . $gall->image) . '" alt="' . $gall->title . '" class="img-thumbnail" width="120" height="120">
                                    <input type="file" class="file_image" style="width: 40%" data-gall_id="' . $gall->id . '" id="file-' . $gall->id . '" name="file" accept="image/*">
                                </td>
                                <td><button type="button" class="delete_gall" data-gall_id="' . $gall->id . '" class="btn btn-xs btn-danger">Delete</button></td>
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
                $image->move('uploads/gallery', $new_image);

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
        $gall_id = $request['gall_id'];
        $gall_text = $request['gall_text'];

        $gallery = Gallery::find($gall_id);
        $gallery->title = $gall_text;
        $gallery->save();
    }

    public function delete_gallery(Request $request)
    {
        $gall_id = $request['gall_id'];

        $gallery = Gallery::find($gall_id);
        unlink('uploads/gallery/' . $gallery->title);
        $gallery->delete();
    }

    public function update_gallery(Request $request)
    {
        $gall_id = $request['gall_id'];
        $get_image = $request->file('file');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/gallery/', $new_image);

            $gallery = Gallery::find($gall_id);
            unlink('uploads/gallery/' . $gallery->title);

            $gallery->title = $new_image;
            $gallery->image = $new_image;
            $gallery->save();

        }
    }

}
