<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model 
{

    protected $table = 'category_post';
    public $timestamps = true;
    protected $fillable = array('category_id', 'post_id');

}