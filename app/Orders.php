<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = [
    	'id',
    	'user_id',
    	'user_name',
    	'user_phone',
    	'user_email',
    	'user_address',
    	'total_price',
    	'status',
    	'order_date',
    	'created_at',
    	'updated_at',
    ];

    public $list_status = ['Chưa giao hàng', 'Đang giao hàng', 'Đã giao hàng'];

    public function storeGetId($req){
        return $this->insertGetId([
            'user_id' => Auth::id(),
            'user_name' => $req->user_name,
            'user_phone' => $req->user_phone,
            'user_email' => $req->user_email,
            'user_address' => $req->user_address,
            'total_price' => (int) Session::get('total_price'),
            'status' => 'Chưa giao hàng',
            'order_date' => new \DateTime(),
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
    }

    public function getOrderById($id){
        return $this->join('order_detail', 'orders.id','=','order_detail.order_id')
        ->where('orders.id', $id)
        ->orderBy('order_detail.detail_line_num', 'asc')
        ->get();
    }

    public function getOrdersByUserId($uid){
        return $this->join('order_detail', 'orders.id', '=', 'order_detail.order_id')
            ->where('orders.user_id', $uid)
            ->groupBy('orders.id')
            ->orderBy('orders.order_date', 'desc')
            ->get();
    }

    public function remove($id){
        Orders::find($id)->delete();
    }
}
