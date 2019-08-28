<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table='products_categories';
    protected $fillable = ['product_id',
    					'category_id',
    					'created_at',
    					'updated_at'
    				];

    public function getAllCateOfProductById($id){
    	$cates = $this->where('products_categories.product_id', $id)
	                ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
	                ->get();
	    $cates_name = [];
        foreach ($cates as $cate) {
            array_push($cates_name, $cate->name);
        }
        return $cates_name;
    }

    public function getAllCateOfProductById_en($id){
        $cates = $this->where('products_categories.product_id', $id)
                    ->join('dt_categories', 'products_categories.category_id', '=', 'dt_categories.id')
                    ->get();
        $cates_name = [];
        foreach ($cates as $cate) {
            array_push($cates_name, [
                'name' => $cate->name,
                'en_name' => strtolower(self::convert_vi_to_en($cate->name))
            ]);
        }
        return $cates_name;
    }

    public function convert_vi_to_en($str){
        if(!$str) return false;
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ',
            'D'=>'Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            '' =>'?|(|)|[|]|{|}|#|%|-|–|<|>|,|:|;|.|&|"|“|”|/',
            '-'=>' '
        );
        foreach($unicode as $khongdau=>$codau) {
            $arr=explode("|",$codau);
            $str = str_replace($arr,$khongdau,$str);
        }
        return $str;
    }
}
