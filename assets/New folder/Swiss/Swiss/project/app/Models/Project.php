<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Generalsetting;
use App\Models\Currency;
use Illuminate\Support\Facades\Session;

class Project extends Model
{

    protected $fillable = ['id','name','contact_date','photo','thumbnail','file','status','ref','offer_date','appointment_place','project_number','project_object','project_administration','project_road','project_place','contact','phone','project_table'];

    public $timestamps = true;

    public function galleries()
    {
        return $this->hasMany('App\Models\Gallery');
    }

}
