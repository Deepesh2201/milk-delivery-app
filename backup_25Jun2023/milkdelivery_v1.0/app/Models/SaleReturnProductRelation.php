<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReturnProductRelation extends Model
{
    use HasFactory;

    function returnProducts(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
