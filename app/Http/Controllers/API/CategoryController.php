<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends Controller
{
    /**
     *  Get Category
     */
    public function getCategory()
    {
        try{
            $category = $this->category::where('status', 1)->get()->map(function($category){
                $category->category_thumb_img = !empty($category->category_thumb_img) ? config('app.asset_url').'/'.$category->category_thumb_img : null;
                $category->background = !empty($category->background) ? config('app.asset_url').'/'.$category->background : null;
                return $category;
            });
            return $this->sendResponse($category, 'get category successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }   
    
}
