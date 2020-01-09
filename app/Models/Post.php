<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'image');
    protected $appends = ['is_favorite'];

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function getIsFavoriteAttribute()
    {
        $client = auth('api')->user() ? auth('api')->user() : auth('client')->user();

        if($client)
        {
            $post = $client->posts()->where('clientable_id', $this->id)->first();
            if($post){
                return true;
            }
        }

        return false;
    }
}
