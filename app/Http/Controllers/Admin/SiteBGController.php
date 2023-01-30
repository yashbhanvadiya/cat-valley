<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteBG;
use Exception;
use View;
use Auth;

class SiteBGController extends Controller
{
    /**
     *  Dispaly Site Background
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = new siteBG;
                if(!empty($request->search)){
                    $result = $result->where('name','like','%'.$request->search.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.site-bg.data', compact('result'))->render();
                return response()->json(['data' => $data]);
            }
            return view('admin.site-bg.index');
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Site Background
     */
    public function addSiteBG(Request $request)
    {
        try{
            $message = "";  
            $addSiteBG = new siteBG;
            $siteBGId = $request->bg_name;
            $message = "site background added successfully";
            if($siteBGId != null){
                $addSiteBG = siteBG::find($siteBGId);
                $message = "site background updated successfully";
            }

            // Upload Category Thumbnail
            if($request->hasfile('sitebg_img')){
                // Update Category Thumbnail
                if(!empty($addSiteBG) && !empty($request->bg_name) && !empty($addSiteBG->image)){
                    if(file_exists('public/'.$addSiteBG->image)){
                        unlink('public/'.$addSiteBG->image);
                    }
                }
                $file = $request->file('sitebg_img');
                $siteBGName = time();
                $siteBGExt = $file->getClientOriginalExtension();
                $siteBG = $siteBGName.'.'.$siteBGExt;
                $file->move(public_path('img/sitebg_images/'), $siteBG);

                $addSiteBG->image = 'img/sitebg_images/'.$siteBG;
            }

            $addSiteBG->name = $request->name;
            $addSiteBG->colour = $request->colour;
            $addSiteBG->created_by = Auth::user()->id;
            $addSiteBG->save();
    
            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Delete Site Background
     */
    public function deleteSiteBG($id)
    {
        try{
            $id = decrypt($id);
            $sitebg = SiteBG::find($id);
            if(file_exists('public/'.$sitebg->image)){
                unlink('public/'.$sitebg->image);
            }
            $sitebg->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Edit Site Background
     */
    public function editSiteBG($id)
    {
        try{
            $id = decrypt($id);
            $data = SiteBG::where('id', $id)->first();
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
