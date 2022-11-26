<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $brandRepository, $categoryRepository, $sliderRepository, $productRepository;

    public function __construct(
        BrandRepository    $brandRepository,
        CategoryRepository $categoryRepository,
        ProductRepository  $productRepository,
        SliderRepository   $sliderRepository,
    )
    {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
        $this->sliderRepository = $sliderRepository;
    }

    public function index()
    {
        $title = "Điện thoại di động";
        $list_brand = $this->brandRepository->getListBrandIndex();
        $list_category = $this->categoryRepository->getListCategoryIndex();
        $list_product = $this->productRepository->getListProductIndex();
        $list_product_sale = $this->productRepository->getListProductSaleIndex();
        $list_recommend = $this->productRepository->getListProductRecommentIndex();
        $first_slider = $this->sliderRepository->getSliderFirstWithProductIndex();
        $list_slider = $this->sliderRepository->getListSliderWithProductIndex($first_slider->id);

        return view('frontend.pages.index')->with(compact('title', 'list_brand', 'list_product', 'list_product_sale', 'list_slider', 'first_slider', 'list_recommend', 'list_category'));
    }

    public function product_loc(Request $request)
    {
        $list_product = $this->productRepository->getListProductArrange('created_at', 'DESC');
        if ($request['value_loc'] == 0) {
            $list_product = $this->productRepository->getListProductArrange('created_at', 'DESC');
        } elseif ($request['value_loc'] == 1) {
            $list_product = $this->productRepository->getListProductArrange('price', 'ASC');
        } elseif ($request['value_loc'] == 2) {
            $list_product = $this->productRepository->getListProductArrange('price', 'DESC');
        }

        $output = '';
        foreach ($list_product as $product) {
            $output .= '
                <div class="col-sm-3">
                    <div class="card p-3 mb-5 bg-body rounded" style="width: 18rem;">
                        <img src="../public/uploads/product/' . $product->image . '" class="card-img-top" alt="' . $product->title . '">
                        <div class="card-body">
                            <h5 class="card-title text-center">' . $product->title . '</h5>
                            <p class="card-subtitle text-center">';
            if ($product->number) {
                if ($product->price_sale) {
                    $output .= '
                                        <del>' . number_format($product->price, 0, '', ',') . ' VND</del>
                                        <b style="color: red"> -' . round(100 - ($product->price_sale / $product->price * 100), PHP_ROUND_HALF_UP) . '%</b>
                                        <br><b>' . number_format($product->price_sale, 0, '', ',') . ' VND</b>';
                } else {
                    $output .= '
                                        <b>' . number_format($product->price, 0, '', ',') . ' VND</b>';
                }
            } else {
                $output .= '
                                    <b style="color: red">Hết Hàng</b>';
            }
            $output .= '
                            </p>
                            <form method="POST" action="' . url('/save-cart') . '" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="' . csrf_token() . '" />
                                <input name="qty" type="hidden" min="1" max="' . $product->number . '" class="cart_product_qty_' . $product->id . '" value="1"/>
                                <input type="hidden" name="productid_hidden" value="' . $product->id . '"/>
                                <a href="' . route('detail', $product->id) . '" class="btn btn-sm btn-outline-secondary">Chi tiết</a>
                                <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
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
        $list_product = $this->productRepository->getListProductFromBrandId($id);

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function category($id)
    {
        $category = $this->categoryRepository->findID($id);
        $title = $category->title;
        $list_brand = $this->brandRepository->getListBrandIndex();
        $list_product = $this->productRepository->getListProductFromCategoryId($id);

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function price($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == 'duoi-2-trieu') {
            $title = 'Điện thoại dưới 2 triệu';
            $list_product = $this->productRepository->getListProductWherePrice('<', 2000000);
        } elseif ($value == 'tu-2-den-4-trieu') {
            $title = 'Điện thoại từ 2 đến 4 triệu';
            $list_product = $this->productRepository->getListProductWherePrices('>=', '<', 2000000, 4000000);
        } elseif ($value == 'tu-4-den-7-trieu') {
            $title = 'Điện thoại từ 4 đến 7 triệu';
            $list_product = $this->productRepository->getListProductWherePrices('>=', '<', 4000000, 7000000);
        } elseif ($value == 'tu-7-den-13-trieu') {
            $title = 'Điện thoại từ 7 đến 13 triệu';
            $list_product = $this->productRepository->getListProductWherePrices('>=', '<', 7000000, 13000000);
        } elseif ($value == 'tu-13-den-20-trieu') {
            $title = 'Điện thoại từ 13 đến 20 triệu';
            $list_product = $this->productRepository->getListProductWherePrices('>=', '<=', 13000000, 20000000);
        } else {
            $title = 'Điện thoại trên 20 triệu';
            $list_product = $this->productRepository->getListProductWherePrice('>', 20000000);
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function ram($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == '2-gb') {
            $title = 'Điện thoại 2 GB Ram';
            $list_product = $this->productRepository->getListProductWhereRam('2GB');
        } elseif ($value == '3-gb') {
            $title = 'Điện thoại 3 GB Ram';
            $list_product = $this->productRepository->getListProductWhereRam('3GB');
        } elseif ($value == '4-gb') {
            $title = 'Điện thoại 4 GB Ram';
            $list_product = $this->productRepository->getListProductWhereRam('4GB');
        } elseif ($value == '6-gb') {
            $title = 'Điện thoại 6 GB Ram';
            $list_product = $this->productRepository->getListProductWhereRam('6GB');
        } elseif ($value == '8-gb') {
            $title = 'Điện thoại 8 GB Ram';
            $list_product = $this->productRepository->getListProductWhereRam('8GB');
        } else {
            $title = 'Điện thoại trên 12 GB Ram';
            $list_product = $this->productRepository->getListProductWhereRam('12GB');
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function dung_luong($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == '32-gb') {
            $title = 'Điện thoại 32 GB Ram';
            $list_product = $this->productRepository->getListProductWhereBoNho('32GB');
        } elseif ($value == '64-gb') {
            $title = 'Điện thoại 64 GB ';
            $list_product = $this->productRepository->getListProductWhereBoNho('64GB');
        } elseif ($value == '128-gb') {
            $title = 'Điện thoại 128 GB';
            $list_product = $this->productRepository->getListProductWhereBoNho('128GB');
        } elseif ($value == '256-gb') {
            $title = 'Điện thoại 256 GB ';
            $list_product = $this->productRepository->getListProductWhereBoNho('256GB');
        } elseif ($value == '512-gb') {
            $title = 'Điện thoại 512 GB';
            $list_product = $this->productRepository->getListProductWhereBoNho('512GB');
        } else {
            $title = 'Điện thoại trên 1 TB';
            $list_product = $this->productRepository->getListProductWhereBoNho('1TB');
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function pin_sac($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == 'pin-khung-tren-5000-mah') {
            $title = 'Pin trên 5000 mAh';
            $list_product = $this->productRepository->getListProductWherePinSac('5%00 mAh');
        } elseif ($value == 'sac-nhanh-tren-20w') {
            $title = 'Sạc nhanh trên 20W ';
            $list_product = $this->productRepository->getListProductWherePinSac('2%W');
        } else {
            $title = 'Sạc không dây';
            $list_product = $this->productRepository->getListProductWherePinSac('Sạc không dây');
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function tinh_nang($value)
    {
        $list_brand = $this->brandRepository->getListBrandIndex();

        if ($value == 'khang-nuoc-bui') {
            $title = 'Kháng nước, Kháng bụi';
            $list_product = $this->productRepository->getListProductWhereTienIch('kháng%nước,%bụi');
        } elseif ($value == 'ho-tro-5g') {
            $title = 'Hỗ trợ 5G';
            $list_product = $this->productRepository->getListProductWhereTienIch('hỗ%trợ%5G');
        } elseif ($value == 'bao-mat-khuon-mat-3d') {
            $title = 'Bảo mật khuôn mặt 3D';
            $list_product = $this->productRepository->getListProductWhereTienIch('bảo mật khuôn mặt 3D');
        } else {
            $title = 'Chống rung quang học';
            $list_product = $this->productRepository->getListProductWhereTienIch('chống rung quang học');
        }

        return view('frontend.pages.search')->with(compact('title', 'list_brand', 'list_product'));
    }

    public function search(Request $request)
    {
        $title = $request['tukhoa'];
        $list_brand = $this->brandRepository->getListBrandIndex();
        $list_product = $this->productRepository->getListProductFromSearch($title);

        return view('frontend.pages.search')->with(compact('list_product', 'list_brand', 'title'));
    }

    public function search_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['keywords']) {
            $product = $this->productRepository->getListProductFromSearch($data['keywords']);

            $output = '<ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="display:block;">';

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
