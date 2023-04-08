<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchasing extends Model
{
    // use HasFactory;

    protected $table = 'm_purchasing';
    protected $primaryKey = 'IdPurchasing';
    public $timestamps = false;
}
