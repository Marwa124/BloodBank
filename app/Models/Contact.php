<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $guarded = array('message');
    protected $fillable = array('name', 'email', 'phone', 'subject');

}