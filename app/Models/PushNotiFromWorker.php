<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotiFromWorker extends Model
{
    use HasFactory;
    protected $fillable =['id_worker','id_work_has','flag','member_read','content_push'];
}
