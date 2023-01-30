<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteBG;
use Exception;

class SiteBGController extends Controller
{
    /**
     *  Get Site Background
     */
    public function getSiteBG()
    {
        try{
            $getSiteBG = SiteBG::get()->map(function($getSiteBG){
                $getSiteBG->image = !empty($getSiteBG->image) ? config('app.asset_url').'/'.$getSiteBG->image : null;
                return $getSiteBG;
            });
            return $this->sendResponse($getSiteBG, 'site background get successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
}
