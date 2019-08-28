<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Product;
use App\Category;
use App\ProductCategory;
use App\ImageUpload;
use App\Orders;
use App\OrderDetail;
use App\Appearance;
use App\Deals;
use App\ProductDeals;
use DB;
use File;
use Session;
use Auth;
use Barryvdh\Debugbar\Facade as Debugbar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product, 
                                Appearance $appearance, 
                                OrderDetail $orderDetail,
                                ProductCategory $productCategory,
                                Category $category,
                                Deals $deal,
                                ProductDeals $productDeals,
                                Orders $order)
    {
        $this->product = $product;
        $this->appearance = $appearance;
        $this->orderDetail = $orderDetail;
        $this->productCategory = $productCategory;
        $this->category = $category;
        $this->order = $order;
        $this->deal = $deal;
        $this->productDeals = $productDeals;
    }

    /**
     * Show home page
     *
     * @return view
     */
    public function index()
    {
      
        $spmoi = $this->product->getNewProducts(10);
        $data = $this->product->getRandProducts(5);
        $slider = $this->appearance->getSliderOrderByDateUpdated();
        $banner = $this->appearance->getBannerOrderByDateUpdated();
        $vbanner = $this->appearance->getVBannerOrderByDateUpdated();

        // san pham HOT: ban nhieu nhat trong vong 5 ngay
        $sphot = $this->orderDetail->getHotProducts(3);

        // san pham ban chay: ban duoc so luong nhieu nhat tu trc den nay
        $spbanchay = $this->orderDetail->getBestSelling(3);

        $categories = $this->category->getAllWithUrl();
        return view('pages.home', ['spmoi' => $spmoi, 
                                    'spdata'     => $data, 
                                    'slider'     => $slider, 
                                    'banner'     => $banner, 
                                    'vbanner'    => $vbanner, 
                                    'sphot'      => $sphot, 
                                    'categories' => $categories,
                                    'spbanchay'  => $spbanchay]);
    }

    /**
     * Show product detail
     *
     * @param $id - product id
     * @return view
     */
    public function showProduct($id){
        $data = $this->product->getProductById($id);
        $cates_data = $this->productCategory->getAllCateOfProductById_en($id);
        $spmoi = $this->product->getNewProducts(5);
        $categories = $this->category->getAllWithUrl();
        $deals_data = $this->deal->getAllDealsByProductId($id);
        $vbanner = $this->appearance->getVBannerOrderByDateUpdated();
        return view('pages.product')
                ->with('data', $data)
                ->with('spmoi', $spmoi)
                ->with('categories', $categories)
                ->with('deals_data', $deals_data)
                ->with('cates_data', $cates_data)
                ->with('vbanner', $vbanner);
    }

    /**
     * Add to cart
     *
     * @param $req Request
     * @return json
     */
    public function ajaxAddToCart(Request $req){
        if (Session::has('products')){
            $found = 0;
            $pro = Session::pull('products', []);
            $products = $pro; 
            foreach ($products as $key => $value) {
                if ($products[$key]['pro_id'] == $req->pro_id){
                    $found = 1;
                    $products[$key]['pro_qty'] += 1;
                }
            }
            Session::put('products', $products);
            if (!$found){
                $item = [
                    'pro_id'    => $req->pro_id,
                    'pro_qty'   => 1,
                    'pro_name'  => $req->pro_name,
                    'pro_code'  => $req->pro_code,
                    'pro_price' => $req->pro_price,
                    'pro_path'  => $req->pro_path,
                ];
                Session::push('products', $item);
            }
        }
        else{
            $item = [
                'pro_id'    => $req->pro_id,
                'pro_qty'   => 1,
                'pro_name'  => $req->pro_name,
                'pro_code'  => $req->pro_code,
                'pro_price' => $req->pro_price,
                'pro_path'  => $req->pro_path,
            ];
            Session::push('products', $item);
        }
        //$req->session()->flush();
        //$req->session()->push(strval($req->pro_id),1);
        return response()->json(['state' => 1, 'count' => count(Session::get('products'))]);
    }

    /**
     * Show cart page
     *
     * @param $request Request
     * @return view
     */
    public function shoppingCart(Request $request){
        if (Session::has('checkout_state')){
                Session::forget('checkout_state');
            }
        $data = Session::get('products');
        $categories = $this->category->getAllWithUrl();
        return view('pages.cart', ['data' => $data, 'categories' => $categories ]);
    }

    /**
     * Remove item from cart
     *
     * @param $req Request
     * @return json
     */
    public function ajaxRemoveFromCart(Request $req){
        if (Session::has('products')){
            $products = Session::pull('products',[]);
            foreach ($products as $key => $value) {
                if ($products[$key]['pro_id'] == $req->pro_id){
                    unset($products[$key]);
                }
            }
            Session::put('products', $products);
        }
        return response()->json($req->pro_id);
    }

    /**
     * Change quanlity of item in cart
     *
     * @param $req Request
     * @return json
     */
    public function ajaxChangeQtyCart(Request $req){
        if (Session::has('products')){
            $products = Session::pull('products',[]);
            foreach ($products as $key => $value) {
                if ($products[$key]['pro_id'] == $req->pro_id){
                    $products[$key]['pro_qty'] = $req->pro_qty;
                }
            }
            Session::put('products', $products);
        }
        return response()->json($req->pro_qty);
    }

    /**
     * Remove all items from cart
     *
     * @param $req Request
     * @return json
     */
    public function ajaxRemoveAllCart(Request $req){
        Session::forget('products');
        return response()->json("Removed all");
    }

    /**
     * Show checkout page
     *
     * @param $req Request
     * @return view
     */
    public function checkout(Request $req){
        $categories = $this->category->getAllWithUrl();
        if ($req->ajax() === true){
            Session::put('total_price', $req->total_price);
            if (!Auth::check()){
                Session::put('link', route('checkout'));
                return response()->json(['state' => 0, 'url' => url('login')]);
            }
            return response()->json(['state' => 1]);
        }
        else{
            if (Session::has('link')){
                Session::forget('link');
            }
            $data = Session::get('products');
            return view('pages.checkout', ['data' => $data, 'categories' => $categories ]);
        }
    }

    function printData($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * Save order data
     *
     * @param $req Request
     * @return url
     */
    public function placeAnOrder(Request $req){
        $validator = Validator::make($req->all(), [
                'user_name'    => 'required',
                'user_phone'   => 'required|min:10|max:11',
                'user_email'   => 'required|email',
                'user_address' => 'required'
            ], 
            [
                'required' => ':attribute không được để trống',
                'min'      => ':attribute quá ngắn',
                'max'      => ':attribute quá dài',
                'email'    => 'Email không đúng',
                'integer'  => 'Số điện thoại không đúng'
            ],
            [
                'user_name'    => 'Tên người nhận',
                'user_phone'   => 'Số điện thoại',
                'user_email'   => 'Email',
                'user_address' => 'Địa chỉ nhận hàng'
            ]
        );

        if ($validator->fails()) {
            return redirect('checkout')
                        ->withErrors($validator)
                        ->withInput($req->all());
        }

        $orderId = $this->order->storeGetId($req);
        foreach (Session::get('products') as $key => $item) {
            $this->orderDetail->store($item, $orderId, $key);
        }
        Session::forget('products');
        Session::forget('total_price');
        return redirect()->route('homepage');
    }

    /**
     * Show view by category
     *
     * @param $categpru
     * @return view
     */
    public function cateProduct($category){
        $vi_cate = $this->category->parseCategoryName($category);
        $data = $this->product->getProductsByCategoryWithPaginage($vi_cate); // limit 16
        $slider = $this->appearance->getSliderOrderByDateUpdated();
        $banner = $this->appearance->getBannerOrderByDateUpdated();
        $sphot = $this->orderDetail->getHotProducts(3);
        $spbanchay = $this->orderDetail->getBestSelling(3);
        $categories = $this->category->getAllWithUrl();

        return view('pages.products-by-cate', [
                        'category_name' => $vi_cate,
                        'spdata' => $data, 
                        'slider' => $slider, 
                        'banner' => $banner, 
                        'sphot' => $sphot, 
                        'categories' => $categories,
                        'spbanchay' => $spbanchay
                    ]);
    }

    /**
     * Show contact page
     *
     * @param $req Request
     * @return json
     */
    public function showContact(){
        $sphot = $this->orderDetail->getHotProducts(3);
        $spbanchay = $this->orderDetail->getBestSelling(3);
        $categories = $this->category->getAllWithUrl();

        return view('pages.contact',['sphot' => $sphot, 'spbanchay' => $spbanchay, 'categories' => $categories]);
    }

    /**
     * Redirect to search result page
     *
     * @param $req Request
     * @return url
     */
    public function search(Request $req){
        return redirect()->route('show-search-result', ['keyword' => $req->get('txt_search') ]);
    }

    /**
     * Show search result page
     *
     * @param $keyword
     * @return view
     */
    public function showSearchResult($keyword){
        if ($keyword == null){
            echo "NULL";
        }
        $data = $this->product->getSearchResult($keyword); // limit 16
        $categories = $this->category->getAllWithUrl();
        return view('pages.search-result', [
                        'searchdata' => $data,
                        'keyword' => $keyword,
                        'categories' => $categories
                    ]);
    }
}
