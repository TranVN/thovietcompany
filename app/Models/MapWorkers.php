<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapWorkers extends Model
{
    use HasFactory;
    protected $fillable =['acc_worker','lat','log','last_active'];
}
