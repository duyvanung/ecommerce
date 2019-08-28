<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDeals extends Model
{
    protected $table = 'product_deals';
    protected $fillable = [
    	'product_id',
    	'deal_id',
    	'created_at',
    	'updated_at'
    ];

    public function getAllDealsOfProductById($id){
    	$deals = $this->where('product_deals.product_id', $id)
	                ->join('deals', 'product_deals.deal_id', '=', 'deals.id')
	                ->get();
	    $deals_name = [];
        foreach ($deals as $deal) {
            array_push($deals_name, $deal->name);
        }
        return $deals_name;
    }
}
