<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use View;
use Auth;

class QuoteController extends Controller
{
    /**
     *  Dispaly Questions
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = $this->quote;
                if(!empty($request->search)){
                    $result = $result->where('writer_name','like','%'.$request->search.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.quote.data', compact('result'))->render();
                return response()->json(['data' => $data]);
            }
            $getQuote = $this->quote::get();
            return view('admin.quote.index', compact('getQuote'));
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Quote
     */
    public function addQuote(Request $request)
    {
        try{
            $addQuote = $this->quote;
            $quoteId = $request->quoteid;
            $message = "quote added successfully";
            if($quoteId != null){
                $addQuote = $this->quote::find($quoteId);
                $message = "quote updated successfully";
            }

            $addQuote->user_id = Auth::user()->id;
            $addQuote->writer_name = $request->writer_name;
            $addQuote->quote = $request->quote;
            $addQuote->save();
    
            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Delete Quote
     */
    public function deleteQuote($id)
    {
        try{
            $id = decrypt($id);
            $this->quote::find($id)->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Edit Quote
     */
    public function editQuote($id)
    {
        try{
            $id = decrypt($id);
            $data = $this->quote->where('id', $id)->first();
            return [
                'status' => 'true',
                'data' => $data,     
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }
}
