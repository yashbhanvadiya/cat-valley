<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TrainerReview;

class Trainer extends Model
{
    use HasFactory;

    public function getTrainerReview() {
        return TrainerReview::where('trainer_id',$this->id)->where('user_id',auth()->guard('api')->user()->id)->first();
    }
}
