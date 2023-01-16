<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Validator;
use Auth;

class QuoteController extends Controller
{
    /**
     *  Add Quotes
     */
    public function addQuote(Request $request)
    {
        try{
            $rule = [
                'writer_name' => 'required',
                'quote' => 'required',
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $addQuote = $this->quote;
            $addQuote->user_id = Auth::user()->id;
            $addQuote->writer_name = $request->writer_name;
            $addQuote->quote = $request->quote;
            $addQuote->save();
    
            return $this->sendResponse($addQuote, 'add quote successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Get Quotes
     */
    public function getQuotes()
    {
        try{
            $id = auth()->guard('api')->user()->id;
            $getQuotes = $this->quote::where('user_id', $id)->get();
            return $this->sendResponse($getQuotes, 'quote get successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     * Delete Quote
     */
    public function deleteQuote(Request $request)
    {
        try{
            $rule = [
                'id' => 'exists:quotes,id'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $deleteQuote = $this->quote::where('id', $request->id)->delete();
            return $this->sendResponse($deleteQuote, 'quote deleted successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     * Update Quote
     */
    public function updateQuote(Request $request)
    {
        try{
            $rule = [
                'id' => 'required|exists:quotes,id',
                'writer_name' => 'required',
                'quote' => 'required'
            ];

            $id = $request->id;
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $updateNotes = $this->quote::where('id', $id)->update([
                'writer_name' => $request->writer_name,
                'quote' =>$request->quote
            ]);
            return $this->sendResponse($updateNotes, 'quotes updated successfully');
        }
        catch(Exception $e){   
            return $this->sendError('something went wrong', 500);
        }
    }
}
