<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;



    function lines(){
        return $this->hasMany(SaleReturnProductRelation::class);
    }

    function oneLine(){
        return $this->hasOne(SaleReturnProductRelation::class);
    }

    function salesman(){
        return $this->belongsTo(User::class, 'salesman_id')->where('role_id', 2);
    }

    function customer(){
        return $this->belongsTo(User::class, 'customer_id')->where('role_id', 1);
    }
}
