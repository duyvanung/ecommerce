<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Barryvdh\Debugbar\Facade as Debugbar;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable = [
    	'order_id',
    	'detail_line_num',
        'product_id',
    	'product_code',
    	'product_name',
    	'product_image',
    	'product_price',
    	'product_qty',
    	'created_at',
    	'updated_at',
    ];

    public function getBestSelling($num){
        return $this->groupBy('product_id')
                    ->whereRaw('product_id in (Select id from dt_products)')
                    ->orderByRaw('sum(product_qty) DESC')
                    ->limit($num)
                    ->get();
    }

    public function getHotProducts($num){
        for ($i = 1; $i< 10; $i++){
            $data = $this->where('created_at','>=',Carbon::now()->subDays(5*$i))
                    ->groupBy('product_id')
                    ->orderByRaw('sum(product_qty) DESC')
                    ->limit($num)
                    ->get();
            if (count($data) > 1) break;
        }
        return $data;
    }

    public function store($item, $orderId, $key){
        OrderDetail::insert([
                'order_id' => $orderId,
                'detail_line_num' => (int) $key,
                'product_id' => $item['pro_id'],
                'product_code' => $item['pro_code'],
                'product_name' => $item['pro_name'],
                'product_image' => $item['pro_path'],
                'product_price' => $item['pro_price'],
                'product_qty' => $item['pro_qty'],
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
    }

    public function remove($id){
        $this->where('order_id',$id)->delete();
    }
}



