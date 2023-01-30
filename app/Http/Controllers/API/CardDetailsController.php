<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Validator;
use Auth;

class CardDetailsController extends Controller
{
    /**
     *  Add Users Card Details
     */
    public function addCard(Request $request)
    {
        try{
            $rule = [
                'name' => 'required',
                'card_number' => 'required',
                'exp_month' => 'required',
                'exp_year' => 'required',
                'type' => 'required',
                'payment_method' => 'required'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $cardlast4digit = substr($request->card_number, -4);
            $userId = auth()->guard('api')->user()->id;
            $user = $this->users::where('id', $userId)->first();

            
            $customer_stripe_token = $user->customer_stripe_token;
            $stripe = new \Stripe\StripeClient(config('app.secret_key'));
            if($customer_stripe_token == null){
                try{
                    $stripeCustomer = $stripe->customers->create([
                        'name' => $user->name,
                        'email' => $user->email,
                    ]);
                    $customer_stripe_token = $stripeCustomer->id;
                    $user->customer_stripe_token = $customer_stripe_token;
                    $user->save();
                }catch(Exception $e) {
                    return $this->sendError(trans('messages.something_went_to_wrong'));
                }
            }

            try{
                $token = $stripe->tokens->create([
                    'card' => [
                        'name' => $request->name,
                        'number' => $request->card_number,
                        'exp_month' => $request->exp_month,
                        'exp_year' => $request->exp_year
                    ],
                ]); 
                $cardSource = $stripe->customers->createSource(
                    $customer_stripe_token,
                    ['source' => $token->id]
                );
            }catch(\Stripe\Exception\CardException $e) {
                return $this->sendError($e->getMessage());
            }

            $cardType = strtoupper($request->type);
            $addCards = $this->cardDetails;
            $addCards->user_id = $userId;
            $addCards->source_id = $cardSource->id;
            $addCards->name = $request->name;
            $addCards->card_number = $cardlast4digit;
            $addCards->exp_month = $request->exp_month;
            $addCards->exp_year = $request->exp_year;
            $addCards->type = $cardType;
            $addCards->payment_method = $request->payment_method;
            $addCards->save();

            return $this->sendResponse($addCards, 'card details added successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Get Users Card Details
     */
    public function getCards()
    {
        try{
            $userId = auth()->guard('api')->user()->id;
            $cardDetails = $this->cardDetails->where('user_id', $userId)->where('payment_method', 1)->get();

            return $this->sendResponse($cardDetails, 'get card details successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Delete Users Card Details
     */
    public function deleteCard(Request $request)
    {
        try{
            $rule = [
                'id' => 'exists:card_details,id'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $userId = auth()->guard('api')->user()->id;
            $deleteCard = $this->cardDetails->where('id', $request->id)->where('user_id', $userId)->first();
            if(!empty($deleteCard)){
                $this->cardDetails->where('id', $deleteCard->id)->where('user_id', $deleteCard->user_id)->delete();
                return $this->sendResponse([],'card delete successfully');
            }
            return $this->sendError('card details not found!');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

}
