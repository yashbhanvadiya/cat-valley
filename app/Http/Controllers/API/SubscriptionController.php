<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class SubscriptionController extends Controller
{
    /**
     *  get subscription list
     */
    public function getSubscription()
    {
        try{
            $getSubscription = $this->subscription::get();
            return $this->sendResponse($getSubscription, 'subscription plan get successfully');
        }   
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
}
