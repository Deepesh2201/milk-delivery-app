<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesProductRelation extends Model
{
    use HasFactory;

    function soldProducts(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
