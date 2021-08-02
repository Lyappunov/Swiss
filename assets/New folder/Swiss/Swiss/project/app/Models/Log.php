<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
	protected $fillable = ['id','storage_idx', 'content','staff_id'];

    public function storage()
    {
        return $this->belongsTo('App\Models\Storage','storage_idx','storage_idx')->withDefault(function ($data) {
            foreach($data->getFillable() as $dt){
                $data[$dt] = __('Deleted');
            }
        });
    }

}
