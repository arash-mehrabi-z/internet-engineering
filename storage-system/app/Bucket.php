<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    /**
     * Get the user that owns the bucket.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the files for the bucket.
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }
}
