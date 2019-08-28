<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Barryvdh\Debugbar\Facade as Debugbar;

class Product extends Model
{
    protected $table='dt_products';
    protected $fillable = ['id',
    					'product_code',
    					'product_name',
    					'description', 
    					'price',
                        'status',
                        'warranty',
    					'created_at',
    					'updated_at'
    				];
    public function getNewProducts($num){
        $spmoi = $this->join('products_categories', 'dt_products.id', '=', 'products_categories.product_id')
        ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
        ->join('imageupload','dt_products.id','=','imageupload.content_id')
        ->select('dt_products.*', 'dt_categories.name', 'imageupload.path')
        ->groupBy('dt_products.id')
        ->orderBy('dt_products.updated_at', 'desc')
        ->limit($num)
        ->get();
        return $spmoi;
    }

    public function getRandProducts($num){
        $randCates = Category::inRandomOrder()->where('dt_categories.level', 1)->limit($num)->get();
        $arr_data = [];
        for ($i =0; $i< $num; $i++){
            $randCateName = $randCates[$i]->name;
            $data = $this->join('products_categories','dt_products.id','=','products_categories.product_id')
            ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
            ->join('imageupload','dt_products.id','=','imageupload.content_id')
            ->where([
                ['dt_categories.name',$randCateName]
            ])
            ->select('dt_products.*', 'dt_categories.name', 'imageupload.path')
            ->groupBy('dt_products.id')
            ->limit(8)
            ->get();
            if (count($data) > 0){
                array_push($arr_data, $data);
            }
        }
        
        return $arr_data;
    }

    public function getProductById($id){
        return $this->where('dt_products.id',$id)
        ->join('imageupload','dt_products.id','=','imageupload.content_id')
        ->select('dt_products.*', 'imageupload.path')
        ->get();
    }

    public function getProductsByCategoryWithPaginage($category){
        return $this->join('products_categories','dt_products.id','=','products_categories.product_id')
            ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
            ->join('imageupload','dt_products.id','=','imageupload.content_id')
            ->where('dt_categories.name',$category)
            ->select('dt_products.*', 'dt_categories.name', 'imageupload.path')
            ->groupBy('dt_products.id')
            ->paginate(16);
    }

    public function getProductsByCategory($category){
        return $this->join('products_categories','dt_products.id','=','products_categories.product_id')
            ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
            ->join('imageupload','dt_products.id','=','imageupload.content_id')
            ->where('dt_categories.name',$category)
            ->select('dt_products.*', 'dt_categories.name', 'imageupload.path')
            ->groupBy('dt_products.id')
            ->get();
    }

    public function store($data){
        
    }

    public function getAllProducts(){
        return $this->leftJoin('products_categories', 'dt_products.id', '=', 'products_categories.product_id')
        ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
        ->join('imageupload','dt_products.id','=','imageupload.content_id')
        ->select('dt_products.*', 'dt_categories.name', 'imageupload.path')
        ->groupBy('dt_products.id')
        ->get();
    }

    public function getAllProductsWithPaginate($num){
        return $this->leftJoin('products_categories', 'dt_products.id', '=', 'products_categories.product_id')
        ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
        ->join('imageupload','dt_products.id','=','imageupload.content_id')
        ->select('dt_products.*', 'dt_categories.name', 'imageupload.path')
        ->groupBy('dt_products.id')
        ->paginate($num);
    }

    public function liveSearch($keyword){
        return $this->select('dt_products.*', 'imageupload.path')
            ->join('imageupload','dt_products.id', '=', 'imageupload.content_id')
            ->groupby('dt_products.id')
            ->where('dt_products.product_name', 'LIKE', "%$keyword%")
            ->limit(5)
            ->get();
    }

    public function getSearchResult($keyword){
        $data = [];
        foreach (DB::table('dt_categories')->get() as $cate) {
            $temp = $this->select('dt_products.*', 'imageupload.path', 'dt_categories.name')
            ->join('imageupload','dt_products.id', '=', 'imageupload.content_id')
            ->join('products_categories', 'dt_products.id','=','products_categories.product_id')
            ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
            ->groupby('dt_products.id')
            ->where([
                ['dt_products.product_name', 'LIKE', "%$keyword%"],
                ['dt_categories.name', $cate->name],
                ['dt_categories.level', 1]
            ])
            ->limit(30)
            ->get();

            if (count($temp) > 0){
                array_push($data, $temp);
            }
        }

        return $data;
    }
}
