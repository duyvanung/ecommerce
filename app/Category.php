<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Barryvdh\Debugbar\Facade as Debugbar;

class Category extends Model
{
    protected $table = 'dt_categories';
    protected $fillable = ['id',
    					'name',
    					'level',
    					'parent_id',
    					'created_at',
    					'updated_at'
    				];

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
        return strtolower($str);
    }

    public function parseCategoryName($str_cate){
    	foreach ($this->all() as $cate) {
    		if (self::convert_vi_to_en($cate->name) == $str_cate){
    			return $cate->name;
    		}
    	}
    	return "none";
    }

    public function getAllWithUrl(){
        $categories = Category::all();
        foreach ($categories as &$cate) {
            $cate->url = route('products-by-cate', [self::convert_vi_to_en($cate->name)]);
        }

        return $categories;
    }
}
