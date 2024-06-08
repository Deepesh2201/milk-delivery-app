<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOnloadingRelation extends Model
{
    use HasFactory;

    function onloading(){
        return $this->belongsTo(Onloading::class, 'onloading_id');
    }
    
    function onloadingProducts(){
       return $this->belongsTo(Product::class, 'product_id');
    }
    
   
}
