<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    // use HasFactory;
    protected $table = 'm_submenu';
    protected $primaryKey = 'IdSubmenu';
    public $timestamps = false;
}
