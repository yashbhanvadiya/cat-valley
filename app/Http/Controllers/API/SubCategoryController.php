<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use Exception;

class SubCategoryController extends Controller
{
    /**
     *  Get Sub Category
     */
    public function getSubCategory()
    {
        try{
            $subCategory = $this->subCategory::where('status', 1)->get()->map(function($subCategory){
                $subCategory->subcategory_thumb_img = config('app.asset_url').'/'.$subCategory->subcategory_thumb_img;
                return $subCategory;
            });
            return $this->sendResponse($subCategory, 'get sub-category successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
}
