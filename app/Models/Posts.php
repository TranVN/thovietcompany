<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Cviebrock\EloquentSluggable\Sluggable;

class Posts extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $fillabbel =['title','slug','description','content','image_post','id_author'];
    
    
}
