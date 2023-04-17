<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    // use HasFactory;

    protected $table = 'm_sales';
    protected $primaryKey = 'IdSales';
    public $timestamps = false;
    protected $fillable = ['IdUser', 'IdSales'];
}
