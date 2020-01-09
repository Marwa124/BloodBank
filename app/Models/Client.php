<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

//use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    //protected $guarded = array('date_of_birth', 'last_donation_date');
    protected $fillable = array('phone', 'password', 'name', 'email', 'pin_code', 'date_of_birth', 'last_donation_date', 'api_token', 'blood_type_id', 'city_id', 'is_active');
    protected $hidden = [
        'password', 'api_token'
    ];

    /*
    * Search Box
    */
    public function ScopeSearch($query, $search)
    {
      return $query->where('name', 'like', '%'. $search .'%');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'clientable');
    }

    public function notifications()
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable')->withPivot('is_read');
    }

    public function bloodTypes()
    {
        return $this->morphedByMany('App\Models\BloodType', 'clientable');
    }

    public function governorates()
    {
        return $this->morphedByMany('App\Models\Governorate', 'clientable');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }
}
