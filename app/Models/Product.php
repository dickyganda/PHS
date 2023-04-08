<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;

    protected $table = 'm_product';
    protected $primaryKey = 'IdProduct';
    public $timestamps = false;

}
