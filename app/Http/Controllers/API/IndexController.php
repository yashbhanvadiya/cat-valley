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
            $category = $this->category::where('status', 1)->get();
            $subCategory = $this->subCategory::where('status', 1)->get();
            $media = $this->media::get();
            $exploreTopic = ['category'=>$category, 'subcategory'=>$subCategory, 'media'=>$media];

            return $this->sendResponse($exploreTopic, 'get explore-topic successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
}
