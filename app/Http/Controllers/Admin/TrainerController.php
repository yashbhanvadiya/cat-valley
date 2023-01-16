<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use View;
use Auth;

class TrainerController extends Controller
{
    /**
     * Display Trainer
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = $this->trainer;
                if(!empty($request->search))
                {
                    $result = $result->where('name','like','%'.$request->search.'%', 'email','like','%'.$request->email.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.trainer.data', compact('result'))->render();
    
                return response()->json(['data' => $data]);
            }
            return view('admin.trainer.index');
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Trainer
     */
    public function addTrainer(Request $request)
    {
        try{
            $message = "";  
            $addTrainer = $this->trainer;
            $trainerId = $request->trainer_name;
            $message = "trainer added successfully";
            if($trainerId != null){
                $addTrainer = $this->trainer::find($trainerId);
                $message = "trainer updated successfully";
            }

            $addTrainer->name = $request->name;
            $addTrainer->email = $request->email;
            $addTrainer->language = implode(',', $request->language);
            $addTrainer->save();
    
            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Delete Trainer
     */
    public function deleteTrainer($id)
    {
        try{
            $id = decrypt($id);
            $trainer = $this->trainer::find($id)->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Edit Trainer
     */
    public function editTrainer($id)
    {
        try{
            $id = decrypt($id);
            $data = $this->trainer->where('id', $id)->first();
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
