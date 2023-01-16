<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class QuizController extends Controller
{
    /**
     * Get Questions
     */
    public function getQuestions()
    {
        try{
            $getQuestions = $this->quiz::get();
            return $this->sendResponse($getQuestions, 'get questions successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
}
