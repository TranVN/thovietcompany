<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $fillable =[
        'worker_name',
        'sort_name',
        'add_woker',
        'phone_ct',
        'phone_cn',
        'kind_worker',
        'status_worker',

    ];
}
