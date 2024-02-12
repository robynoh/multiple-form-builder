<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;
    protected $fillable = [
        'userID',
        'userpackage',
        'type',
        'start_warning_at',
        'ends_at',
        'invoiceID',
        'amount',
        'status',
       
    ];
}
