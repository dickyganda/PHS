<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    // use HasFactory;
    protected $table = 't_kas';
    protected $primaryKey = 'IdKas';
    public $timestamps = false;
}
