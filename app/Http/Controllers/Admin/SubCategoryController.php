<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use View;
use Auth;

class SubCategoryController extends Controller
{
    /**
     *  Display Sub Category
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = $this->subCategory;
                if(!empty($request->search)){
                    $result = $result->where('name','like','%'.$request->search.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.sub-category.data', compact('result'))->render();
    
                return response()->json(['data' => $data]);
            }
            $getCategory = $this->category::where('status', 1)->pluck('name', 'id');
            return view('admin.sub-category.index', compact('getCategory'));
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Sub Category
     */
    public function addSubCategory(Request $request)
    {
        try{
            $message = "";
            $addSubCategory = $this->subCategory;
            $subcategoryId = $request->subcategoryid;
            $message = "sub-category added successfully";
            if($subcategoryId != null){
                $addSubCategory = $this->subCategory::find($subcategoryId);
                $message = "sub-category updated successfully";
            }

            // Upload Sub Category Thumbnail
            if($request->hasfile('subcategory_thumb_img')){
                // Update Sub Category Thumbnail
                if(!empty($addSubCategory) && !empty($request->subcategoryid) && !empty($addSubCategory->subcategory_thumb_img)){
                    if(file_exists('public/'.$addSubCategory->subcategory_thumb_img)){
                        unlink('public/'.$addSubCategory->subcategory_thumb_img);
                    }
                }
                $file = $request->file('subcategory_thumb_img');
                $thumbImageName = time();
                $thumbImageExt = $file->getClientOriginalExtension();
                $thumbImage = $thumbImageName.'.'.$thumbImageExt;
                $file->move(public_path('img/subcategory_thumb_images/'), $thumbImage);

                $addSubCategory->subcategory_thumb_img = 'img/subcategory_thumb_images/'.$thumbImage;
            }
            // Upload Sub Category Background
            if($request->hasfile('background')){
                // Update Sub Category Background
                if(!empty($addSubCategory) && !empty($request->subcategoryid) && !empty($addSubCategory->background)){
                    if(file_exists('public/'.$addSubCategory->background)){
                        unlink('public/'.$addSubCategory->background);
                    }
                }
                $file = $request->file('background');
                $backgroundImageName = time();
                $backgroundImageExt = $file->getClientOriginalExtension();
                $backgroundImage = $backgroundImageName.'.'.$backgroundImageExt;
                $file->move(public_path('img/subcategory_background_images/'), $backgroundImage);

                $addSubCategory->background = 'img/subcategory_background_images/'.$backgroundImage;
            }
            
            $addSubCategory->category_id = $request->category_name;
            $addSubCategory->name = $request->name;
            $addSubCategory->colour = $request->colour;
            $addSubCategory->status = $request->status;
            $addSubCategory->save();
    
            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Delete Sub Category
     */
    public function deleteSubCategory($id)
    {
        try{
            $id = decrypt($id);
            $subCategory = $this->subCategory::find($id);
            if(file_exists('public/'.$subCategory->subcategory_thumb_img)){
                unlink('public/'.$subCategory->subcategory_thumb_img);
            }
            $subCategory->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Edit Sub Category
     */
    public function editSubCategory($id)
    {
        try{
            $id = decrypt($id);
            $data = $this->subCategory->where('id', $id)->first();
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
