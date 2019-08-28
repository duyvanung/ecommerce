<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
    protected $table = 'deals';
    protected $fillable = [
    	'id',
    	'name',
    	'created_at',
    	'updated_at'
    ];

    public function getAllDealsByProductId($id){
    	return $this->join('product_deals','deals.id','=','product_deals.deal_id')
    		->where('product_deals.product_id', $id)
    		->select('deals.*')
    		->get();
    }
}
