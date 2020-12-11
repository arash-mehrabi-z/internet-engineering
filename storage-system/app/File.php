<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * Get the bucket that owns the file.
     */
    public function bucket()
    {
        return $this->belongsTo('App\Bucket');
    }

}
