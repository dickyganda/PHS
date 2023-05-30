<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuedDetail extends Model
{
    // use HasFactory;

    protected $table = 'm_issued_detail';
    protected $primaryKey = 'IdIssuedDetail';
    public $timestamps = false;
}
