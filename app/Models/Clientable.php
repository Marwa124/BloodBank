<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientable extends Model 
{

    protected $table = 'clientables';
    public $timestamps = true;
    protected $fillable = array('is_read');

}