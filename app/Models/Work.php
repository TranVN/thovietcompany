<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $fillable =[
        'name_cus',
        'date_book',
        'work_note',
        'work_content',
        'street',
        'district',
        'phone_number',
        'kind_work',
        'from_cus',
        'flag_status',
        'members_read'
    ];
}
