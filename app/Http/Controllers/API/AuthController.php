<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Validator;
use Hash;
use Auth;

class AuthController extends Controller
{
    /**
     *  Login
     */
    public function login(Request $request)
    {
        try{  
            $validator = Validator::make($request->all(),[
                'login_type' => 'required',
                'email' => 'required|email'
            ]);

            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), [], 422);
            }

            if($request->login_type == 1){
                $validator = Validator::make($request->all(),[
                    'login_type' => 'required',
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
                
                if($validator->fails()) {
                    return $this->sendError($validator->errors()->first(), [], 422);
                }
        
                $email = $request->email;
                $password = $request->password;
                if (Auth::attempt(['email' => $email, 'password' => $password])) {
                    $user = Auth::user();
                    $success['token'] = $user->createToken('login')->accessToken;
                    $updateLoginType = $this->users::where('id', Auth::user()->id)->update(['login_type'=> $request->login_type]);
    
                    return $this->sendResponse($success, 'user login successfully');
                }
            }
    
            if(in_array($request->login_type, [2,3,4])){
                $emailExist = $this->users::where('email', $request->email)->first();
                if(empty($emailExist)){
                    $addUser = $this->users;
                    $addUser->email = $request->email;
                    $addUser->login_type = $request->login_type;
                    $addUser->save();
                    Auth::loginUsingId($addUser->id);
                    $user = Auth::user();
                    $success['token'] = $user->createToken('login')->accessToken;
                } else {
                    $emailExist->login_type = $request->login_type;
                    $emailExist->save();
                    Auth::loginUsingId($emailExist->id);
                    $user = Auth::user();
                    $success['token'] = $user->createToken('login')->accessToken;
                }
                return $this->sendResponse($success, 'user login successfully');
            }
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Register
     */
    public function register(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->sendError($validator->errors()->first(), [], 422);
            }
    
            $addUser = $this->users;
            $addUser->name = $request->name;
            $addUser->email = $request->email;
            $addUser->password = Hash::make($request->password);
            $addUser->role = $request->role;
            $addUser->save();
            
            return $this->sendResponse($addUser, 'user added successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Edit Profile
     */
    public function editProfile(Request $request)
    {
        try{
            $editUser = [
                'name' => $request->name,
                'phone' => $request->phone,
                'age' => $request->age
            ];

            $id = auth()->guard('api')->user()->id;
            if($request->hasfile('image')){
                $file = $request->file('image');
                $image = time().".".$file->getClientOriginalExtension();
                $file->move(public_path('users_image/'),$image);
                if($id != null){
                    $UserRec = $this->users::find($id);
                    if($UserRec->image) {
                        $path = public_path("users_image/$UserRec->image");
                        if(file_exists($path))
                        {
                            unlink($path);
                        }
                    }
                    $editUser['image'] = $image;
                }
            }

            $getUser = $this->users::where('id', $id)->update($editUser);
            return $this->sendResponse($getUser, 'user update successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
}
