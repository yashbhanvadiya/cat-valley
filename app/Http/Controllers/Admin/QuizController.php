<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Auth;
use View;

class QuizController extends Controller
{
    /**
     *  Dispaly Questions
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = $this->quiz;
                if(!empty($request->search)){
                    $result = $result->where('question','like','%'.$request->search.'%')
                            ->orWhere('option_one','like','%'.$request->search.'%')->orWhere('option_two','like','%'.$request->search.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.quiz.data', compact('result'))->render();
                
                return response()->json(['data' => $data]);
            }
            $getQuiz = $this->quiz::where('status', 1)->get();
            return view('admin.quiz.index', compact('getQuiz'));
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Questions
     */
    public function addQuestion(Request $request)
    {
        try{
            $message = "";
            $addQuestion = $this->quiz;
            $questionId = $request->questionid;
            $message = "question added successfully";
            if($questionId != null){
                $addQuestion = $this->quiz::find($questionId);
                $message = "question updated successfully";
            }
            $addQuestion->question = $request->question;
            $addQuestion->option_one = $request->option_one;
            $addQuestion->option_two = $request->option_two;
            $addQuestion->answer = $request->answer;
            $addQuestion->status = $request->status;
            $addQuestion->created_by = Auth::user()->id;
            $addQuestion->save();
            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Delete Questions
     */
    public function deleteQuestion($id)
    {
        try{
            $id = decrypt($id);
            $this->quiz::find($id)->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Edit Questions
     */
    public function editQuestion($id)
    {
        try{
            $id = decrypt($id);
            $data = $this->quiz->where('id', $id)->first();
            return [
                'status' => 'true',
                'data' => $data
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }
}
