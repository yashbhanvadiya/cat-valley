<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Validator;
use Auth;

class TransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        try{
            $rule = [
                'accept_with' => 'required',
                'card_id' => 'required'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $userId = auth()->guard('api')->user()->id;
            $getCard = $this->cardDetails::where('id', $request->card_id)->where('user_id', $userId)->first();
            if(empty($getCard)){
                return $this->sendError('card not found!', 500);
            }

            $user = $this->users::where('id', $userId)->first();
            $getSubscription = $this->subscription::where('id', $request->subscription_id)->first();
            $total_pay = $getSubscription->price; 

            $stripe = new \Stripe\StripeClient(config('app.secret_key'));
            try{
                $charge = $stripe->paymentIntents->create([
                    'amount' => $total_pay * 100,
                    'currency' => 'inr',
                    'description' => $user->name." paid INR ".$total_pay." for plan ".$getSubscription->name,
                    "customer" => $user->customer_stripe_token,
                    // 'source' => $getCard->source_id,
                    'payment_method_types' => ['card'],
                ]);

                $card_id = $getCard->id;
            }
            catch(\Stripe\Exception\InvalidRequestException $e) {
                return $this->sendError($e->getMessage());
            }
            catch(\Stripe\Exception\CardException $e) {
                return $this->sendError($e->getMessage());
            }

            $createTransactin = $this->transaction;
            $createTransactin->sender_id = $userId;
            $createTransactin->subscription_id = $getSubscription->id;
            $createTransactin->accept_with = $request->accept_with;
            $createTransactin->card_id = $card_id;
            $createTransactin->amount = $total_pay;
            $createTransactin->description = $charge['description'];
            $createTransactin->save();

            return $this->sendResponse($createTransactin, 'your create transaction successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
}
