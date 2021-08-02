<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
	protected $fillable = ['storage_idx','storage_ID', 'location','hotel_id', 'quantity','tire_size', 'tire_brand', 'tire_brand_image', 'weather', 'photos', 'is_rim','rim_size','is_changed','staff_id', 'car_license', 'car_make','is_picked_up','condition'];

    public function hotel_storage()
    {
        return $this->belongsTo('App\Models\HotelStorage','hotel_id','hotel_id')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

    public function logs()
    {
        return $this->hasMany('App\Models\Log','storage_idx','storage_idx');
    }

}
