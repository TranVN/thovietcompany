<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolWorkerLoan extends Model
{
    use HasFactory;
    protected $fillable =['content_loan','name_worker','type_loan','date_loan'];
}
