<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldCustu extends Model
{
    use HasFactory;
    protected $fillable =[
        'work_content',
        'name_cus',
        'date_book',
        'warranty_period',
        'add_cus',
        'des_cus',
        'phone_cus',
        'note_cus',
        'worker_name',
        'income_total',
        'spending_total',
        'seri_number',
	    'cus_show',
       ];
}
