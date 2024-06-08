<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onloading extends Model
{
    use HasFactory, SoftDeletes;
    /* get all onloading for this perticular id*/
    function lines(){
        return $this->hasMany(ProductOnloadingRelation::class, 'onloading_id');
    }
    function oneLine(){
        return $this->hasOne(ProductOnloadingRelation::class, 'onloading_id');
    }

    function salesman(){
        return $this->belongsTo(User::class, 'salesman_id')->where('role_id', 2);
    }

}
