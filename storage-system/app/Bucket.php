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
}
