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
use DB;


class SearchController extends Controller
{
    public function liveSearch(Request $req){
    	if ($req->keyword == ""){
    		return response()->json("");
    	}
    	$product = new Product();
    	$data_search = $product->liveSearch($req->keyword);
    	$html = '';
    	foreach ($data_search as $item) {
    		$html.= '<a href="'. route('product-detail', ['id' => $item->id]) .'">'.
						'<div class="item-thumbnail">'.
							'<img src="'. asset('uploads').'/'.$item->path .'">'.
						'</div>'.
						'<div class="item-info">'.
							'<div class="item-name">'.
								str_limit($item->product_name, $limit = 50, $end = '...').
							'</div>'.
							'<div class="item-price">'.
								number_format($item->price).' đ'.
							'</div>'.
						'</div>'.
					'</a>';
    	}
    	return response()->json($html);
    }
}
