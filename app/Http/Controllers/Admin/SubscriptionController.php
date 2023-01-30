<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use View;
use Auth;

class SubscriptionController extends Controller
{
    /**
     *  Display Subscription
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = $this->subscription;
                if(!empty($request->search))
                {
                    $result = $result->where('name','like','%'.$request->search.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.subscription.data', compact('result'))->render();
    
                return response()->json(['data' => $data]);
            }
            return view('admin.subscription.index');
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Subscription
     */
    public function addSubscription(Request $request)
    {
        try{
            $message = "";  
            $addSubscription = $this->subscription;
            $subscriptionId = $request->subscriptionid;
            $message = "Subscription added successfully";
            if($subscriptionId != null){
                $addSubscription = $this->subscription::find($subscriptionId);
                $message = "Subscription updated successfully";
            }

            $addSubscription->name = $request->name;
            $addSubscription->price = $request->price;
            $addSubscription->subscription_duration = $request->subscription_duration;
            $addSubscription->created_by = Auth::user()->id;
            $addSubscription->save();
    
            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            abort(500);
        }
    }
     /**
     *  Delete Subscription
     */
    public function deleteSubscription($id)
    {
        try{
            $id = decrypt($id);
            $subscription = $this->subscription::find($id)->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }
    /**
     *  Edit Subscription
     */
    public function editSubscription($id)
    {
        try{
            $id = decrypt($id);
            $data = $this->subscription->where('id', $id)->first();
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
