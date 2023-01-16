<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Validator;

class TrainerController extends Controller
{
    /**
     *  Add Trainer Review
     */
    public function trainerReview(Request $request)
    {
        try{
            $rule = [
                'trainer_id' => 'required',
                'rating' => 'required'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $user_id = auth()->guard('api')->user()->id;
            $getTrainerReview = $this->trainerReview::where('user_id', $user_id)->where('trainer_id', $request->trainer_id)->first();

            $addReviwe = '';
            if(empty($getTrainerReview)){
                $addReviwe = $this->trainerReview;
                $addReviwe->user_id = $user_id;
                $addReviwe->trainer_id = $request->trainer_id;
                $addReviwe->rating = $request->rating;
                $addReviwe->review = $request->review;
                $addReviwe->save();
                $message = 'trainer review added successfully';
            }
            $message = 'you have already added the trainer review';

            return $this->sendResponse($addReviwe, $message);
        }
        catch(Exception $e)
        {
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Get Trainer
     */
    public function getTrainer(Request $request)
    {
        try{
            $getTrainer = $this->trainer::get();
            $getTrainer = collect($getTrainer)->map(function($query) use($request){
                $query->trainer_review = $query->getTrainerReview();
                return $query;
            });

            return $this->sendResponse($getTrainer, 'get trainer successfully');
        }
        catch(Exception $e)
        {
            return $this->sendError('something went wrong', 500);
        }
    }
}
