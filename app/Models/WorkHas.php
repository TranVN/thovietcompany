<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHas extends Model
{
    use HasFactory;
    protected $fillable =[
        'id_cus',
        'id_worker',
        'id_phu',
        'warranty_period',
        'real_note',
        'income_total',
        'spending_total',
        'seri_number',];
}
