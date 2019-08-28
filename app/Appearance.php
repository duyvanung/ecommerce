<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appearance extends Model
{
    protected $table = 'appearance';
    protected $fillable = [
    					'id',
    					'widget_type',
    					'path',
    					'created_at',
    					'updated_at'
    				];

    public function getSliderOrderByDateUpdated(){
    	return $this->where('widget_type','slider')->orderBy('updated_at','desc')->get();
    }

    public function getBannerOrderByDateUpdated(){
    	return $this->where('widget_type','banner')->orderBy('updated_at','desc')->limit(2)->get();
    }

    public function getVBannerOrderByDateUpdated(){
        return $this->where('widget_type','vbanner')->orderBy('updated_at','desc')->first();
    }

    public function getAllSlider(){
    	return $this->where('widget_type', 'slider')->get();
    }

    public function getAllBanner(){
    	return $this->where('widget_type', 'banner')->get();
    }

    public function getAllVerticalBanner(){
        return $this->where('widget_type', 'vbanner')->get();
    }
}
