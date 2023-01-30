<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class IndexController extends Controller
{
    public function exploreTopic()
    {
        try{
            $category = $this->category::where('status', 1)->get()->map(function($category){
                $category->category_thumb_img = !empty($category->category_thumb_img) ? config('app.asset_url').'/'.$category->category_thumb_img : null;
                $category->background = !empty($category->background) ? config('app.asset_url').'/'.$category->background : null;
                return $category;
            });

            $subCategory = $this->subCategory::where('status', 1)->get()->map(function($subCategory){
                $subCategory->subcategory_thumb_img = !empty($subCategory->subcategory_thumb_img) ? config('app.asset_url').'/'.$subCategory->subcategory_thumb_img : null;
                $subCategory->background = !empty($subCategory->background) ? config('app.asset_url').'/'.$subCategory->background : null;
                return $subCategory;
            });
            
            $media = $this->media::get()->map(function($media){
                $media->media = !empty($media->media) ? config('app.asset_url').'/'.$media->media : null;
                $media->media_thumb_img = !empty($media->media_thumb_img) ?  asset('/').$media->media_thumb_img : null;
                return $media;
            });
          
            $exploreTopic = ['category'=>$category, 'subcategory'=>$subCategory, 'media'=>$media];

            return $this->sendResponse($exploreTopic, 'get explore-topic successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
}
