<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use View;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display Category
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = $this->category;
                if(!empty($request->search))
                {
                    $result = $result->where('name','like','%'.$request->search.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.category.data', compact('result'))->render();
    
                return response()->json(['data' => $data]);
            }
            return view('admin.category.index');
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Category
     */
    public function addCategory(Request $request)
    {
        try{
            // return $request;
            $message = "";  
            $addCategory = $this->category;
            $categoryId = $request->categoryid;
            $message = "category added successfully";
            if($categoryId != null){
                $addCategory = $this->category::find($categoryId);
                $message = "category updated successfully";
            }

            // Upload Category Thumbnail
            if($request->hasfile('category_thumb_img')){
                // Update Category Thumbnail
                if(!empty($addCategory) && !empty($request->categoryid) && !empty($addCategory->category_thumb_img)){
                    if(file_exists('public/'.$addCategory->category_thumb_img)){
                        unlink('public/'.$addCategory->category_thumb_img);
                    }
                }
                $file = $request->file('category_thumb_img');
                $thumbImageName = time();
                $thumbImageExt = $file->getClientOriginalExtension();
                $thumbImage = $thumbImageName.'.'.$thumbImageExt;
                $file->move(public_path('img/category_thumb_images/'), $thumbImage);

                $addCategory->category_thumb_img = 'img/category_thumb_images/'.$thumbImage;
            }
            if($request->hasfile('background')){
                // Update Category Background
                if(!empty($addCategory) && !empty($request->categoryid) && !empty($addCategory->background)){
                    if(file_exists('public/'.$addCategory->background)){
                        unlink('public/'.$addCategory->background);
                    }
                }
                $file = $request->file('background');
                $backgroundImageName = time();
                $backgroundImageExt = $file->getClientOriginalExtension();
                $backgroundImage = $backgroundImageName.'.'.$backgroundImageExt;
                $file->move(public_path('img/category_background_images/'), $backgroundImage);

                $addCategory->background = 'img/category_background_images/'.$backgroundImage;
            }

            // Disable Sub Category
            if($request->status == 2){
                $categoryId = $request->categoryid;
                $getSubCategory = $this->subCategory::where('category_id', $categoryId)->update(['status' => 2]);
            }

            $addCategory->name = $request->name;
            $addCategory->colour = $request->colour;
            $addCategory->status = $request->status;
            $addCategory->save();
            
            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Delete Category
     */
    public function deleteCategory($id)
    {
        try{
            $id = decrypt($id);
            $category = $this->category::find($id);
            if(file_exists('public/'.$category->category_thumb_img)){
                unlink('public/'.$category->category_thumb_img);
            }
            $category->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Edit Category
     */
    public function editCategory($id)
    {
        try{
            $id = decrypt($id);
            $data = $this->category->where('id', $id)->first();
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
