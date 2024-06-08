<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    function lines(){
        return $this->hasMany(SalesProductRelation::class);
    }

    function oneLine(){
        return $this->hasOne(SalesProductRelation::class);
    }

    function salesman(){
        return $this->belongsTo(User::class, 'salesman_id')->where('role_id', 2);
    }

    function customer(){
        return $this->belongsTo(User::class, 'customer_id')->where('role_id', 1);
    }

    function getStatusAttribute(){

       return $this->hasMany(SaleReturnProductRelation::class, 'sale_id')->count();
        
    }
}
