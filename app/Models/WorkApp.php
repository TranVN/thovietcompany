<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkApp extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_cus',
        'name_cus',
        'add_cus',
        'des_cus',
        'phone_cus',
        'req_cus',
        'note_cus',
        'kind_book',
        'bookd_cus',
        'flag_book',
        'from_table',
        'employ_seen',
        'cancel_cause',
    ];
}
