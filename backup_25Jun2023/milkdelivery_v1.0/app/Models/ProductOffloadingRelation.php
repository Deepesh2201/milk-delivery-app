<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOffloadingRelation extends Model
{
    use HasFactory;
    function offloadingProducts(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
