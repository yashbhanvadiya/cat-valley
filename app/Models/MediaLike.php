<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaLike extends Model
{
    use HasFactory;

    public function getMedia() {
        return $this->belongsTo('App\Models\Media','media_id');
    }

    public function getUser() {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
