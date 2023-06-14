<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // use HasFactory;
    protected $table = 'm_menu';
    protected $primaryKey = 'IdMenu';
    public $timestamps = false;
}