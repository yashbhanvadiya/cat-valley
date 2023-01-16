<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Validator;
use Auth;

class NotesController extends Controller
{
    /**
     *  Add Notes
     */
    public function addNotes(Request $request)
    {   
        try{
            $rule = [
                'title' => 'required',
                'description' => 'required',
                'date' => 'required'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $addNotes = $this->notes;
            $addNotes->user_id = Auth::user()->id;
            $addNotes->title = $request->title;
            $addNotes->description = $request->description;
            $addNotes->date = $request->date;
            $addNotes->time = $request->time;
            $addNotes->save();
            return $this->sendResponse($addNotes, 'notes added successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Get Notes
     */
    public function getNotes()
    {
        try{
            $getNotes = $this->notes::where('user_id', Auth::user()->id)->get();
            return $this->sendResponse($getNotes, 'notes get successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     * Delete Notes
     */
    public function deleteNotes(Request $request)
    {
        try{
            $rule = [
                'id' => 'exists:notes,id'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $deleteNotes = $this->notes::where('id', $request->id)->delete();
            return $this->sendResponse($deleteNotes, 'notes deleted successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     * Update Notes
     */
    public function updateNotes(Request $request)
    {
        try{
            $rule = [
                'id' => 'required|exists:notes,id',
                'title' => 'required',
                'description' => 'required',
                'date' => 'required'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $updateNotes = $this->notes::where('id', $request->id)->update([
                'title' => $request->title,
                'description'=>$request->description
            ]);
            return $this->sendResponse($updateNotes, 'notes updated successfully');
        }
        catch(Exception $e){   
            return $this->sendError('something went wrong', 500);
        }
    }
}
