<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offloading extends Model
{
    use HasFactory;
    function lines(){
        return $this->hasMany(ProductOffloadingRelation::class, 'offloading_id');
    }
    function oneLine(){
        return $this->hasOne(ProductOnloadingRelation::class, 'offloading_id');
    }

    function salesman(){
        return $this->belongsTo(User::class, 'salesman_id')->where('role_id', 2);
    }

    function onloading(){
        return $this->belongsTo(Onloading::class, 'onloading_id');
    }
}
