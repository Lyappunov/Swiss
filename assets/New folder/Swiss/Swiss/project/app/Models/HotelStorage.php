<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelStorage extends Model
{
	protected $fillable = ['hotel_id', 'customer_name','social_id', 'home_address', 'phone', 'email','staff_id'];

    public function storage()
    {
        return $this->hasMany('App\Models\Storage','hotel_id','hotel_id');
    }

}
