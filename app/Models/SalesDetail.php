<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    // use HasFactory;

    protected $table = 'm_sales_detail';
    protected $primaryKey = 'IdSalesDetail';
    public $timestamps = false;

}
