<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use View;
use Auth;
use Hash;

class UsersController extends Controller
{
    /**
     *  Display Users
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = $this->users::whereIn('role', [2,3]);
                if(!empty($request->search)){
                    $result = $result->where('name','like','%'.$request->search.'%')
                        ->orWhere('email','like','%'.$request->search.'%')->orWhere('phone','like','%'.$request->search.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.users.data', compact('result'))->render();
    
                return response()->json(['data' => $data]);
            }
            return view('admin.users.index');
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Users
     */
    public function addUsers(Request $request)
    {
        try{
            $id = "";
            $message = "";
            $users = $this->users;
            $message = "user added successfully";

            if($request->userid != null){
                $userId = decrypt($request->userid);
                $users = $this->users::find($userId);
                $message = "user updated successfully";
            }        

            if($request->hasfile('image')){
                $file = $request->file('image');
                $image = time().".".$file->getClientOriginalExtension();
                $file->move(public_path('users_image/'),$image);
                if($request->userid != null){
                    $id = decrypt($request->userid);
                    $UserRec = $this->users::find($id);
                    if($UserRec->image) {
                        $path = public_path("users_image/$UserRec->image");
                        if(file_exists($path))
                        {
                            unlink($path);
                        }
                    }
                    $userEditRec['image'] = $image;
                }
                $users->image = $image;
            }

            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = Hash::make($request->password);
            $users->phone = $request->phone;
            $users->age = $request->age;
            $users->sex = $request->sex;
            $users->role = $request->role;
            $users->message = $request->message;
            $users->save();
            
            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Delete Users
     */
    public function deleteUsers($id)
    {
        try{
            $id = decrypt($id);
            $this->users::find($id)->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     * Display Single User Page
     */
    public function showUsers($id)
    {
        try{
            $id = decrypt($id);
            $showUser = $this->users::find($id);
            return view('admin.users.user', compact('showUser'));
        }
        catch(Exception $e){
            abort(500);
        }
    }
}
