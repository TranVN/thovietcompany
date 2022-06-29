<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeedWork extends Model
{
    use HasFactory;
    protected  $fillable =['id_worker','content'];
}
