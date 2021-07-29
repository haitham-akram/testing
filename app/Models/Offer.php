<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
   // protected $table = 'offers'; if table name wasn't the same name of model
    //protected $primaryKey ='id'; if the id in the table wasn't named id
    protected $fillable =['name_ar','name_en','details_ar','details_en','price','img','created_at','updated_at','deleted_at'];
    protected $hidden = ['created_at','updated_at','deleted_at'];
}
