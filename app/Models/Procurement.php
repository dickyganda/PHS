<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    // use HasFactory;

    protected $table = 'm_procurement';
    protected $primaryKey = 'IdProcurement';
    public $timestamps = false;
}
