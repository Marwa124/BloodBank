<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $guarded = array('notes');
    protected $fillable = array('patient_name', 'patient_age', 'bags_num', 'hospital_name', 'hospital_address', 'latitude', 'longitude', 'phone', 'blood_type_id', 'city_id', 'client_id');

    public function ScopeSearch($query, $search)
    {
      return $query->where('patient_name', 'like', '%'. $search .'%');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

}
