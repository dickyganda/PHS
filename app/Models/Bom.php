<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    // use HasFactory;

    protected $table = 'm_bom';
    protected $primaryKey = 'IdBom';
    public $timestamps = false;
}
