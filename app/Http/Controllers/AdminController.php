<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\Input;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Product $product,
                                ProductCategory $productCategory,
                                Appearance $appearance,
                                Orders $order,
                                Deals $deal,
                                ProductDeals $productDeals,
                                OrderDetail $orderDetail)
    {
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->appearance = $appearance;
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->deal = $deal;
        $this->productDeals = $productDeals;
    }

    /**
     * Show dashboard default page
     *
     * @return view
     */
    public function index()
    {
        return view('adminlte::page');
    }

    /**
     * Get category of product by id
     *
     * @param $id
     * @return $category
     */
    private function pro2cate($id){
        $pro_cate = ProductCategory::where('product_id',$id);
        return $pro_cate;
    }

    /**
     * Show all products page
     *
     * @return view
     */
    public function allProducts(){
        $data = $this->product->getAllProductsWithPaginate(5);
        return view('dashboard.products',compact('data'));
    }

    function printData($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    /**
     * Show add new product page
     *
     * @return view
     */
    public function addProduct(){
        $cate_data = Category::all();
        $deal_data = Deals::all();
        return view('dashboard.add-product', compact('cate_data', 'deal_data'));
    }

    /**
     * Remove product from DB by id
     *
     * @param $id
     * @return url
     */
    public function removeProduct($id){
        ProductCategory::where('product_id', $id)->delete();
        $del = DB::table('imageupload')->where('content_id', $id)->get();
        foreach ($del as $img) {
            $path = public_path().'/uploads/'.$img->path;
            if( file_exists($path) ){
                //File::delete('uploads/'.$img->path);
                unlink($path);
            }
            ImageUpload::find($img->id)->delete();
        }
        Product::find($id)->delete();
        return redirect('admin/products');
    }

    /**
     * Show edit product page
     *
     * @param $id
     * @return json
     */
    public function editProduct($id){
        $product = $this->product->getProductById($id);
        $cates = Category::all();
        $deals = Deals::all();
        $selectedCate_name = $this->productCategory->getAllCateOfProductById($id);
        $selectedDeal_name = $this->productDeals->getAllDealsOfProductById($id);

        return view('dashboard.edit-product', compact('product', 'cates','selectedCate_name', 'deals', 'selectedDeal_name'));
    }

    /**
     * update product
     *
     * @param $id
     * @return url
     */
    public function updateProduct($id, Request $request){

        $product = Product::find($id);
        $product->product_code = $request->get('pro-code');
        $product->product_name = $request->get('pro-name');
        $product->description = $request->get('pro-descript');
        //$product->image_id = self::imageUploadPost($request);
        $product->price = $request->get('pro-price');
        $product->status = $request->get('pro-status');
        $product->warranty = $request->get('pro-warranty');
        $product->updated_at = new \DateTime();
        $product->save();

        ProductCategory::where('product_id', $id)
        ->update([
            'category_id' => Category::where('name',$request->get('category'))->get()[0]->id,
            'updated_at' => new \DateTime()
        ]);
        return redirect('admin/products');
    }

    /**
     * Show categories page
     *
     * @return view
     */
    public function allCategories(){
        $data = Category::paginate(10);
        return view('dashboard.categories-products',compact('data'));
    }

    /**
     * Save product
     *
     * @param $request Request
     * @return url
     */
    public function saveProduct(Request $request){
       //self::printData($request->all());
        Product::insert([
            'product_code' => $request->get('pro-code'),
            'product_name' => $request->get('pro-name'),
            'description' => $request->get('pro-descript'),
            'price' => $request->get('pro-price'),
            'status' => $request->get('pro-status'),
            'warranty' => $request->get('pro-warranty'),
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
        ProductCategory::insert([
            'product_id' => Product::all()->last()->id,
            'category_id' => Category::where('name', $request->get('category'))->first()->id,
            'updated_at' => new \DateTime(),
            'created_at' => new \DateTime()
        ]);
        return redirect('admin/products');        
    }

    public function getNewCategory($cateName){
        Category::all()->last()->id;        
    }

    /**
     * Ajax save product
     *
     * @param $request Request
     * @return json
     */
    public function ajaxSavePost(Request $request)
    {
        $pId = DB::table('dt_products')->insertGetId([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'description' => $request->product_description,
            'price' => $request->product_price,
            'status' => $request->product_status,
            'warranty' => $request->product_warranty,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
        foreach ($request->product_images as $imageName) {
            ImageUpload::insert([
                'content_id' => $pId,
                'path'=> $imageName,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        }
        foreach ($request->product_category as $cate_name) {
            ProductCategory::insert([
                'product_id' => $pId,
                'category_id' => Category::where('name', $cate_name)->first()->id,
                'updated_at' => new \DateTime(),
                'created_at' => new \DateTime()
            ]);
        }
        if (count($request->product_deals) > 0){
            foreach ($request->product_deals as $deal_name) {
                ProductDeals::insert([
                    'product_id' => $pId,
                    'deal_id' => Deals::where('name', $deal_name)->first()->id,
                    'updated_at' => new \DateTime(),
                    'created_at' => new \DateTime()
                ]);
            }
        }
        //return url('admin/products');
        return response()->json(['success'=>"Thành công rồi !!!"]);
    }   

    /**
     * Ajax update product
     *
     * @param $request Request
     * @return json
     */

    public function ajaxUpdatePost(Request $request)
    {
        $pId = $request->product_id;
        ImageUpload::where('content_id', $pId)->delete();
        foreach ($request->product_images as $imageName) {
            ImageUpload::insert([
                'content_id' => $pId,
                'path'=> $imageName,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        }
        Product::find($pId)->update([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'description' => $request->product_description,
            'price' => $request->product_price,
            'status' => $request->product_status,
            'warranty' => $request->product_warranty,
            'updated_at' => new \DateTime()
        ]);
        ProductCategory::where('product_id', $pId)->delete();
        foreach ($request->product_category as $cate_name) {
            ProductCategory::insert([
                'product_id' => $pId,
                'category_id' => Category::where('name', $cate_name)->first()->id,
                'updated_at' => new \DateTime(),
            ]);
        }

        ProductDeals::where('product_id', $pId)->delete();
        foreach ($request->product_deals as $deal_name) {
            ProductDeals::insert([
                'product_id' => $pId,
                'deal_id' => Deals::where('name', $deal_name)->first()->id,
                'updated_at' => new \DateTime(),
            ]);
        }

        //return url('admin/products');
        return response()->json(['success'=>"Thành công rồi !!!"]);
    }   

    /**
     * Show edit product page
     *
     * @param $id
     * @return json
     */
    public function storeImg(Request $request)
    {
        $imageName = request()->file->getClientOriginalName();
        request()->file->move(public_path('uploads'), $imageName);
        return response()->json(['uploaded' => '/uploads/'.$imageName]);
    }

    /**
     * upload widget: banner, vbannder, slider
     *
     * @param $req Request
     * @return json
     */
    public function widgetUpload(Request $req){
        // save to public/uploads
        $imageName = request()->file->getClientOriginalName();
        request()->file->move(public_path('images'), $imageName);
        // save path to DB
        // Debugbar::info($req->request->get('widget_type'));
        Appearance::insert([
            'widget_type' => $req->request->get('widget_type'),
            'path' => $imageName,
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
        return response()->json(['uploaded' => '/images/'.$imageName]);
    }

    /**
     * Remove image from DB and store
     *
     * @param $request Request
     * @return json
     */
    public function ajaxRequestPost(Request $request)
    {
        // delete image from public/uploads
        $file_path = public_path().'/uploads/'.$request->name;
        if (file_exists($file_path)){
            unlink($file_path);
        }
        // delete image from DB
        ImageUpload::where('path', $request->name)->delete();
        return response()->json(['success'=>$request->name]);
    }

    /**
     * Add new category
     *
     * @return view
     */
    public function addCategory(){
        $cates_level_1 = Category::whereNull('parent_id')->get();
        return view('dashboard.add-categories-products',['cates_level_1' => $cates_level_1]);
    }

    /**
     * Add new deal
     *
     * @return view
     */
    public function addDeal(){
        return view('dashboard.add-deals-products');
    }

    /**
     * Show all deals page
     *
     * @return view
     */
    public function allDeals(){
        $data = Deals::paginate(10);
        return view('dashboard.deals-products',compact('data'));
    }

    /**
     * Save deal to DB
     *
     * @param $request Request
     * @return url
     */
    public function saveDeal(Request $request){
        if (Deals::where('name', $request->get('deal'))->exists()){
            // found
        }
        else{
            Deals::insert([
                'name' => $request->get('deal'),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        }
        return redirect()->route('all-deals');
    }

    /**
     * Show edit deal page
     *
     * @param $id
     * @return view
     */
    public function editDeal($id){
        $deal_data = Deals::find($id);
        return view('dashboard.edit-deals-products',[
                'deal_data' => $deal_data,
            ]);
    }

    /**
     * update deal
     *
     * @param $id, $req Request
     * @return url
     */
    public function updateDeal(Request $req, $id){
        Deals::find($id)->update([
            'name' => $req->get('deal'),
            'updated_at' => new \DateTime()
        ]);
        return back();
    }

    /**
     * Remove deal from DB
     *
     * @param $id
     * @return url
     */
    public function removeDeal($id){
        Deals::find($id)->delete();
        return redirect()->route('all-deals');
    }

    /**
     * Save category to DB
     *
     * @param $request Request
     * @return url
     */
    public function saveCategory(Request $request){
        if (Category::where('name', $request->get('category'))->exists()){
            // found
        }
        else{
            $level = $request->get('parent') == ''? 1 : 2;
            if ($level == 1){
                $parent = null;
            }
            else{
                $parent = Category::where('name', $request->get('parent'))->first()->id;
            }
            Category::insert([
                'name' => $request->get('category'),
                'level' => $level,
                'parent_id' => $parent,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
        }
        return redirect()->route('all-categories');
    }

    /**
     * Show edit category page
     *
     * @param $id
     * @return view
     */
    public function editCategory($id){
        $cate_data = Category::find($id);
        $all_cates = Category::all();
        $selected_cate = Category::find($cate_data->parent_id);

        return view('dashboard.edit-categories-products',[
                'cate_data' => $cate_data,
                'all_cates' => $all_cates,
                'selected_cate' => $selected_cate
            ]);
    }

    /**
     * Update category
     *
     * @param $id, $req Request
     * @return url
     */
    public function updateCategory(Request $req, $id){
        $level = $req->get('parent') == '' ? 1 : 2;
        if ($level == 1){
            $parent = null;
        }
        else{
            $parent = Category::where('name', $req->get('parent'))->first()->id;
        }
        Category::find($id)->update([
            'name' => $req->get('category'),
            'level' => $level,
            'parent_id' => $parent,
            'updated_at' => new \DateTime()
        ]);
        return back();
    }

    /**
     * Remove category
     *
     * @param $id
     * @return url
     */
    public function removeCategory($id){
        Category::find($id)->delete();
        return redirect()->route('all-categories');
    }

    /**
     * Show all orders page
     *
     * @return view
     */
    public function allOrders(){
        $data = Orders::paginate(10);
        $selected_status = "";
        return view('dashboard.orders', ['orders' => $data, 'list_status' => $this->order->list_status, 'selected_status' => $selected_status]);
    }

    /**
     * Show order detail page
     *
     * @param $id
     * @return view
     */
    public function orderDetail($order_id){
        $data = $this->order->getOrderById($order_id);
        return view('dashboard.order-detail', ['data' => $data, 'list_status' => $this->order->list_status]);
    }

    /**
     * Show edit product page
     *
     * @param $id
     * @return json
     */
    public function changeOrderStatus(Request $req){
        Orders::find($req->order_id)->update([
            'status' => $req->status
        ]);
        return response()->json("Đã lưu");
    }

    /**
     * Remove order
     *
     * @param $req Request
     * @return json
     */
    public function deleteOrder(Request $req){
        $this->orderDetail->remove($req->order_id);
        $this->order->remove($req->order_id);
        return response()->json("Đã xóa");
    }

    /**
     * Show edit product page
     *
     * @param $id
     * @return json
     */
    public function getOrdersByStatus($stt){
        $selected_status = self::parseOrderStatusName($stt);
        
        $data = Orders::where('status', $selected_status)->paginate(10);
        return view('dashboard.orders',['orders' => $data, 'list_status' => $this->order->list_status, 'selected_status' => $selected_status]);
    }

    /**
     * Convert slug status to vi status
     *
     * @param $slug_status
     * @return $vi_status
     */
    function parseOrderStatusName($str_stt){
        if ($str_stt == "chua-giao-hang"){
            return "Chưa giao hàng";
        } 
        else if ($str_stt == "dang-giao-hang"){
            return "Đang giao hàng";
        } 
        else if ($str_stt == "da-giao-hang"){
            return "Đã giao hàng";
        } 
    }

    /**
     * Show banner manager page
     *
     * @return view
     */
    public function changeBanner(){
        $banner = $this->appearance->getAllBanner();
        return view('dashboard.banner',['banner' => $banner]);
    }

    /**
     * Show vertical banner manager page
     *
     * @return view
     */
    public function changeVerticalBanner(){
        $vbanner = $this->appearance->getAllVerticalBanner();
        return view('dashboard.vertical-banner',['vbanner' => $vbanner]);
    }

    /**
     * Show slider manager page
     *
     * @return view
     */
    public function changeSlider(){
        $slider = $this->appearance->getAllSlider();
        return view('dashboard.slider',['slider' => $slider]);
    }

    /**
     * Remove widget
     *
     * @param $request Request
     * @return json
     */
    public function removeWidget(Request $request){
        // delete image from public/uploads
        $file_path = public_path().'/images/'.$request->name;
        if (file_exists($file_path)){
            unlink($file_path);
        }
        // delete image from DB
        Appearance::where([
            ['widget_type', '=', $request->widget_type],
            ['path','=', $request->name]
        ])->delete();
        return response()->json(['success'=>$request->name]);
    }
}
