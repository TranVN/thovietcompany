<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffWorkers extends Model
{
    use HasFactory;
    protected $fillable = ['id_worker','date_off','time_off'];
}
