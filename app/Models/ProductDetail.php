<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    // use HasFactory;

    protected $table = 'm_product_detail';
    protected $primaryKey = 'IdProductDetail';
    public $timestamps = false;
}
