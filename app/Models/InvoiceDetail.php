<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    // use HasFactory;

    protected $table = 'm_invoice_detail';
    protected $primaryKey = 'IdInvoiceDetail';
    public $timestamps = false;
}
