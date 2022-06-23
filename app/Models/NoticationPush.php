<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticationPush extends Model
{
    use HasFactory;
    protected $fillable =[
        'emp_wrote', 'noti_content','push_place'
    ];
}
