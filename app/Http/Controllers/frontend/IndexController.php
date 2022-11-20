<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        $title = "Điện thoại di động";
        $list_brand = $this->brandRepository->getListBrandIndex();

        $list_category = Category::where('status', 0)->get();
        $list_product = Product::where('number', '>', 2)->where('status', 0)->orderBy('created_at', 'DESC')->take(4)->get();
        $list_product_sale = Product::where('price_sale', '!=', '0')->where('number', '>', 2)->where('status', 0)->orderBy('price_sale', 'ASC')->take(4)->get();
        $list_recommend = Product::orderBy('updated_at', 'DESC')->take(10)->get();

        $first_slider = Slider::with('reProduct')->where('status', 0)->orderBy('id', 'ASC')->first();
        $list_slider = Slider::with('reProduct')->where('id', '>', $first_slider->id)->where('status', 0)->take(2)->get();

        return view('frontend.pages.index')
            ->with(compact('title', 'list_brand', 'list_product', 'list_product_sale', 'list_slider', 'first_slider', 'list_recommend', 'list_category'));
    }

    public function product_loc(Request $request)
    {
        $list_product = Product::where('number', '>', 2)->where('status', 0)->orderBy('created_at', 'DESC')->take(8)->get();
        if($request['value_loc'] == 0) {
            $list_product = Product::where('number', '>', 2)->where('status', 0)->orderBy('created_at', 'DESC')->take(8)->get();
        }elseif($request['value_loc'] == 1){
            $list_product = Product::where('number', '>', 2)->where('status', 0)->orderBy('price', 'ASC')->take(8)->get();
        }elseif($request['value_loc'] == 2){
            $list_product = Product::where('number', '>', 2)->where('status', 0)->orderBy('price', 'DESC')->take(8)->get();
        }

        $output = '';
        foreach ($list_product as $product) {
            $output .= '
                <div class="col-sm-3">
                    <div class="card p-3 mb-5 bg-body rounded" style="width: 18rem;">
                        <img src="../public/uploads/product/'.$product->image.'" class="card-img-top" alt="'.$product->title.'">
                        <div class="card-body">
                            <h5 class="card-title text-center">'.$product->title.'</h5>
                            <p class="card-subtitle text-center">';
                                if($product->number){
                                    if($product->price_sale){
                                    $output.='
                                        <del>'. number_format($product->price, 0, '', ',') .' VND</del>
                                        <b style="color: red"> -'.round(100 - ($product->price_sale / $product->price * 100), PHP_ROUND_HALF_UP).'%</b>
                                        <br><b>'. number_format($product->price_sale, 0, '', ',') .' VND</b>';
                                    }else{
                                        $output.='
                                        <b>'. number_format($product->price, 0, '', ',') .' VND</b>';
                                    }
                                }else{
                                 $output.='
                                    <b style="color: red">Hết Hàng</b>';
                                }
                            $output.='
                            </p>
                            <form method="POST" action="'.url('/save-cart').'" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="'. csrf_token() .'" />
                                <input name="qty" type="hidden" min="1" max="'.$product->number.'" class="cart_product_qty_'.$product->id.'" value="1"/>
                                <input type="hidden" name="productid_hidden" value="'.$product->id.'"/>
                                <a href="'.route('detail', $product->id).'" class="btn btn-sm btn-outline-secondary">Detail</a>
                                <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>';
        }
        echo $output;
    }

    public function brand($id)
    {
        $brand = $this->brandRepository->findID($id);
        $title = $brand->title;

        $list_brand = $this->brandRepository->getListBrandIndex();

        $list_product = Product::where('brand_id', $id)->get();

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function category($id)
    {
        $category = Category::find($id);
        $title = $category->title;

        $list_brand = $this->brandRepository->getListBrandIndex();
        $list_product = Product::where('category_id', '=', $id)->get();

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function price($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == 'duoi-2-trieu') {
            $title = 'Điện thoại dưới 2 triệu';
            $list_product = Product::where('price', '<', 2000000)->get();
        } elseif ($value == 'tu-2-den-4-trieu') {
            $title = 'Điện thoại từ 2 đến 4 triệu';
            $list_product = Product::where('price', '>=', 2000000)->where('price', '<=', 4000000)->get();
        } elseif ($value == 'tu-4-den-7-trieu') {
            $title = 'Điện thoại từ 4 đến 7 triệu';
            $list_product = Product::where('price', '>=', 4000000)->where('price', '<=', 7000000)->get();
        } elseif ($value == 'tu-7-den-13-trieu') {
            $title = 'Điện thoại từ 7 đến 13 triệu';
            $list_product = Product::where('price', '>=', 7000000)->where('price', '<=', 13000000)->get();
        } elseif ($value == 'tu-13-den-20-trieu') {
            $title = 'Điện thoại từ 13 đến 20 triệu';
            $list_product = Product::where('price', '>=', 13000000)->where('price', '<=', 20000000)->get();
        } else {
            $title = 'Điện thoại trên 20 triệu';
            $list_product = Product::where('price', '>', 20000000)->get();
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function ram($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == '2-gb') {
            $title = 'Điện thoại 2 GB Ram';
            $list_product = Product::where('ram', '2GB')->get();
        } elseif ($value == '3-gb') {
            $title = 'Điện thoại 3 GB Ram';
            $list_product = Product::where('ram', '3GB')->get();
        } elseif ($value == '4-gb') {
            $title = 'Điện thoại 4 GB Ram';
            $list_product = Product::where('ram', '4GB')->get();
        } elseif ($value == '6-gb') {
            $title = 'Điện thoại 6 GB Ram';
            $list_product = Product::where('ram', '6GB')->get();
        } elseif ($value == '8-gb') {
            $title = 'Điện thoại 8 GB Ram';
            $list_product = Product::where('ram', '8GB')->get();
        } else {
            $title = 'Điện thoại trên 12 GB Ram';
            $list_product = Product::where('ram', '12GB')->get();
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function dung_luong($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == '32-gb') {
            $title = 'Điện thoại 32 GB Ram';
            $list_product = Product::where('bonho', '32GB')->get();
        } elseif ($value == '64-gb') {
            $title = 'Điện thoại 64 GB ';
            $list_product = Product::where('bonho', '64GB')->get();
        } elseif ($value == '128-gb') {
            $title = 'Điện thoại 128 GB';
            $list_product = Product::where('bonho', '128GB')->get();
        } elseif ($value == '256-gb') {
            $title = 'Điện thoại 256 GB ';
            $list_product = Product::where('bonho', '256GB')->get();
        } elseif ($value == '512-gb') {
            $title = 'Điện thoại 512 GB';
            $list_product = Product::where('bonho', '512GB')->get();
        } else {
            $title = 'Điện thoại trên 1 TB';
            $list_product = Product::where('bonho', '1TB')->get();
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function pin_sac($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == 'pin-khung-tren-5000-mah') {
            $title = 'Pin trên 5000 mAh';
            $list_product = Product::where('pin_sac', 'LIKE', '5' . '%' . '00 mAh' . '%')->get();
        } elseif ($value == 'sac-nhanh-tren-20w') {
            $title = 'Sạc nhanh trên 20W ';
            $list_product = Product::where('pin_sac', 'LIKE', '%' . '2' . '%' . ' W' . '%')->get();
        } else {
            $title = 'Sạc không dây';
            $list_product = Product::where('pin_sac', 'LIKE', '%' . 'Sạc không dây' . '%')->get();
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function tinh_nang($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == 'khang-nuoc-bui') {
            $title = 'Kháng nước, Kháng bụi';
            $list_product = Product::where('tienich', 'LIKE', '%' . 'kháng nước, bụi' . '%')->get();
        } elseif ($value == 'ho-tro-5g') {
            $title = 'Hỗ trợ 5G';
            $list_product = Product::where('tienich', 'LIKE', '%' . 'hỗ trợ 5g' . '%')->get();
        } elseif ($value == 'bao-mat-khuong-mat-3d') {
            $title = 'Bảo mật khuôn mặt 3D';
            $list_product = Product::where('tienich', 'LIKE', '%' . 'bảo mật khuôn mặt 3d' . '%')->get();
        } else {
            $title = 'Chống rung quang học';
            $list_product = Product::where('tienich', 'LIKE', '%' . 'chống rung quang học' . '%')->get();
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function search(Request $request)
    {
        $data = $request->all();
        $title = $data['tukhoa'];

        $list_brand = $this->brandRepository->getListBrandIndex();
        $list_product = Product::where('title', 'LIKE', '%' . $title . '%')->get();

        return view('frontend.pages.search')->with(compact('list_product', 'list_brand', 'title'));
    }

    public function search_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['keywords']) {
            $product = Product::where('status', 0)->where('title', 'LIKE', '%' . $data['keywords'] . '%')->get();

            $output = '<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="display:block;"><h5 style="text-align: center">Sản phẩm gợi ý</h5><hr>';

            foreach ($product as $prod) {
                $output .= '<li>
                                <a class="dropdown-item" href="#">
                                    <img width="90" src="../public/uploads/product/' . $prod->image . '" alt="' . $prod->title . '">
                                    <b class="li_search_ajax">' . $prod->title . '</b>
                                </a>
                            </li><hr>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
