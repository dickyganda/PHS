<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingDetail extends Model
{
    // use HasFactory;

    protected $table = 'm_purchasing_detail';
    protected $primaryKey = 'IdPurchasingDetail';
    public $timestamps = false;
}
