<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_cus_app',
        'name_cus_app',
        'phone_cus_app',
        'pass_cus_app',
        'add_cus_app',
        'des_cus_app',
		'avatar',
        'path',
        'sex_cus_app',
        'email_cus_app',
        'birth_day_cus_app',
       ];
}
