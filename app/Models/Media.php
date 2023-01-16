<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MediaLike;
use App\Models\MediaReview;
use DB;

class Media extends Model
{
    use HasFactory;

    protected $table = "media";

    public function getCategory() {
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function getSubCategory() {
        return $this->belongsTo('App\Models\SubCategory','sub_category_id');
    }

    public function getMediaLike() {
        return MediaLike::where('media_id',$this->id)->where('user_id',auth()->guard('api')->user()->id)->first();
    }

    public function getMediaReview() {
        return MediaReview::with('getUser')->where('media_id',$this->id)->get();
    }

}