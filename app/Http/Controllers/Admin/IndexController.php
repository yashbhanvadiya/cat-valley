<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Auth;

class IndexController extends Controller
{
    /**
     *  Login
     */
    public function login()
    {
        try{
            if(Auth::check())
            {
                return redirect('/admin');
            }
            return view('login');
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Check Login Data
     */
    public function loginData(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
    
            // $credentials = $request->only('email', 'password');
            $email = $request->email;
            $password = $request->password;
    
            if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 1])) {
                return redirect('/admin/dashboard');
            }
    
            session()->flash('loginError','invalid email & password');
            
            return redirect('admin/login');
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Logout
     */
    public function logout()
    {
        try{
            Auth::logout();
            return redirect('admin/login');
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Display Index Page
     */
    public function index()
    {
        try{
            return view('admin.index');
        }
        catch(Exception $e){
            abort(500);
        }
    }
}
