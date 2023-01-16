<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use View;
use Auth;

class MediaController extends Controller
{
    /**
     *  Display Media
     */
    public function index(Request $request)
    {
        try{
            if($request->ajax()){
                $result = $this->media;
                if(!empty($request->search)){
                    $result = $result->where('media_title','like','%'.$request->search.'%');
                }
                $result = $result->paginate(20);
                $data = View::make('admin.media.data', compact('result'))->render();
    
                return response()->json(['data' => $data]);
            }
            $data['getCategory'] = $this->category::where('status', 1)->pluck('name', 'id');
            return view('admin.media.index', compact('data'));
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Get Sub Category Data
     */
    public function getSubCategory(Request $request)
    {
        try{
            $data['getSubCategory'] = $this->subCategory->where('category_id', $request->category_id)->where('status', 1)->get();
            return response()->json($data);
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Add Media
     */
    public function addMedia(Request $request)
    {
        try{
            $message = "";
            $addMedia = $this->media;
            $message = "media added successfully";
            $mediaExt = "";

            if($request->mediaid != null){
                $mediaId = $request->mediaid;
                $addMedia = $this->media::find($mediaId);
                $message = "media updated successfully";
            }   

            // Upload Audio or Video Media
            if($request->hasfile('media')){
                // Update Audio or Video Media
                if(!empty($addMedia) && !empty($request->mediaid)){
                    if(file_exists('public/'.$addMedia->media) && !empty($addMedia->media)){
                        unlink('public/'.$addMedia->media);
                    }
                }

                $mediaPath = '';
                $file = $request->file('media');
                $mediaName = time().$file->getClientOriginalName();
                $mediaExt = $file->getClientMimeType();
                if(explode('/', $mediaExt)[0] == 'audio'){
                    $mediaPath = 'media/audio/'.$mediaName;
                    $file->move(public_path('media/audio/'), $mediaName);
                }
                else{
                    $mediaPath = 'media/video/'.$mediaName;
                    $file->move(public_path('media/video/'), $mediaName);
                }
                $addMedia->media = $mediaPath;
            }

            // Upload Media Thumbnail
            if($request->hasfile('media_thumb_img')){
                // Update Media Thumbnail
                if(!empty($addMedia) && !empty($request->mediaid)){
                    if(file_exists('public/'.$addMedia->media_thumb_img) && !empty($addMedia->media_thumb_img)){
                        unlink('public/'.$addMedia->media_thumb_img);
                    }
                }
                $file = $request->file('media_thumb_img');
                $thumbImageName = time();
                $thumbImageExt = $file->getClientOriginalExtension();
                $thumbImage = $thumbImageName.'.'.$thumbImageExt;
                $file->move(public_path('thumb_images/'), $thumbImage);

                $addMedia->media_thumb_img = 'thumb_images/'.$thumbImage;
            }

            $addMedia->media_type = (explode('/', $mediaExt)[0] == 'audio') ? '1' : '2';
            $addMedia->media_title = $request->media_title;
            $addMedia->category_id = $request->category_name;
            $addMedia->sub_category_id = $request->sub_category_name;
            $addMedia->status = $request->status;
            $addMedia->created_by = Auth::user()->id;
            $addMedia->save();

            return redirect()->back()->with('success', $message);
        }
        catch(Exception $e){
            dd($e);
            abort(500);
        }
    }

    /**
     *  Delete Media
     */
    public function deleteMedia($id)
    {
        try{
            $id = decrypt($id);
            $media = $this->media::find($id);
            if(file_exists('public/'.$media->media)){
                unlink('public/'.$media->media);
            }
            if(file_exists('public/'.$media->media_thumb_img)){
                unlink('public/'.$media->media_thumb_img);
            }
            $media->delete();
            return [
                'status' => 200
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Edit Media
     */
    public function editMedia($id)
    {
        try{
            $id = decrypt($id);
            $data = $this->media->where('id', $id)->first();
            return [
                'status' => 'true',
                'data' => $data
            ];
        }
        catch(Exception $e){
            abort(500);
        }
    }

    /**
     *  Get Sub Category Data
     */
    public function getSubCategoryData(Request $request)
    {
        try {
            $data['subCategoryData'] = $this->subCategory->where('category_id', $request->category_id)->where('status', 1)->get();
            return response()->json($data);
        }catch(Exception $e) {
            abort(500);
        }
    }
}