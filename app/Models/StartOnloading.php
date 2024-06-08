<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartOnloading extends Model
{
    use HasFactory;
    protected $table = 'start_onloading';
    protected $primaryKey = 'id';
}
