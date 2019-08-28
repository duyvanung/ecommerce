<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageUpload extends Model
{
    protected $table='imageupload';
    protected $fillable = ['id',
    					'content_id',
    					'path',
    					'created_at',
    					'updated_at'
    				];

    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
