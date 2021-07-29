<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable =['name','title','gender','hospital_id','created_at','updated_at','deleted_at'];
    protected $hidden=['created_at','updated_at','deleted_at','pivot'];
    public function Hospital(){
        return $this->belongsTo('App\Models\Hospital','hospital_id');
    }
    public function Services(){
    return $this->belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');
    }

}
