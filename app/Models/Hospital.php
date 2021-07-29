<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable =['name','address','created_at','updated_at','deleted_at'];
    protected $hidden=['created_at','updated_at','deleted_at'];
    public function Doctors(){
    return $this->hasMany('App\Models\Doctor','hospital_id');
    }
}
