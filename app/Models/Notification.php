<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'donation_request_id');

    /** NOtification has to be belonges to only one donation request  or order request
    *   while Donation Request has one notification or
    *      Order Request has Many Notification (arrive, recive, fail)
    */
    public function donationRequest()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable')->withPivot('is_read');
    }

}
