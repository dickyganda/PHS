<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomDetail extends Model
{
    // use HasFactory;

    protected $table = 'm_bom_detail';
    protected $primaryKey = 'IdBomDetail';
    public $timestamps = false;
}
