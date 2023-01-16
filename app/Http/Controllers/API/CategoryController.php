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
                $category->category_thumb_img = config('app.asset_url').'/'.$category->category_thumb_img;
                return $category;
            });
            return $this->sendResponse($category, 'get category successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }   
    
}
