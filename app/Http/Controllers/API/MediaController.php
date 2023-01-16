<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Exception;
use Auth;
use DB;

class MediaController extends Controller
{
    /**
     *  Video List
     */
    public function index(Request $request)
    {
        try{
            $media_list = $this->media->where('media_type',2)->get();
            $media_list = collect($media_list)->map(function($query) use($request){
                $query->media_thumb_img = !empty($query->media_thumb_img) ? $request->getSchemeAndHttpHost().'/public/'.$query->media_thumb_img : '';
                $query->media = !empty($query->media) ? $request->getSchemeAndHttpHost().'/public/'.$query->media : '';
                $query->like = !empty($query->getMediaLike()) && $query->getMediaLike()->status == '1' ? true : false;
                $query->avg_rating = !empty($query->getMediaReview()->avg('rating')) ? $query->getMediaReview()->avg('rating') : 0;
                $query->review = !empty($query->getMediaReview()) ? $query->getMediaReview() : [];
                return $query;
            });
            return $this->sendResponse($media_list, 'get video successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Audio List
     */
    public function getAudioList(Request $request)
    {
        try{
            $media_list = $this->media->where('media_type',1)->get();
            $media_list = collect($media_list)->map(function($query) use($request){
                $query->media_thumb_img = !empty($query->media_thumb_img) ? $request->getSchemeAndHttpHost().'/public/'.$query->media_thumb_img : '';
                $query->media = !empty($query->media) ? $request->getSchemeAndHttpHost().'/public/'.$query->media : '';
                $query->like = !empty($query->getMediaLike()) && $query->getMediaLike()->status == '1' ? true : false;
                $query->avg_rating = !empty($query->getMediaReview()->avg('rating')) ? $query->getMediaReview()->avg('rating') : 0;
                $query->review = !empty($query->getMediaReview()) ? $query->getMediaReview() : [];
                return $query;
            });
            return $this->sendResponse($media_list, 'get audio successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     * update media Like-unlike
     */
    public function likeUnlikeMedia(Request $request)
    {
        try{
            $rule = [
                'media_id' => 'required|exists:media,id',
                'status' => 'required|in:0,1',
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }
            $user_id = auth()->guard('api')->user()->id;
            $media_like = $this->mediaLike->where('user_id',$user_id)->where('media_id',$request->media_id)->first();
            if(empty($media_like))
            {
                $media_like = $this->mediaLike;
            }
            $media_like->user_id = $user_id;
            $media_like->media_id = $request->media_id;
            $media_like->status = $request->status;
            $media_like->save();
            return $this->sendResponse($media_like, 'update media like successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     * store media review
     */
    public function addMediaReview(Request $request)
    {
        try{
            $rule = [
                'media_id' => 'required|exists:media,id',
                'rating' => 'required',
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }
            $user_id = auth()->guard('api')->user()->id;
            $media_review = $this->mediaReview->where('user_id',$user_id)->where('media_id',$request->media_id)->first();
            if(empty($media_review))
            {
                $media_review = $this->mediaReview;
            }
            $media_review->user_id = $user_id;
            $media_review->media_id = $request->media_id;
            $media_review->rating = $request->rating;
            $media_review->review = !empty($request->review) ? $request->review : '';
            $media_review->save();
            return $this->sendResponse($media_review, 'store media review successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
    * store media favourite
    */
    public function storeMediaFavourite(Request $request)
    {
        try{
            $rule = [
                'media_id' => 'required|exists:media,id',
                'status' => 'required|in:0,1',
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }
            $user_id = auth()->guard('api')->user()->id;
            $mediaFavourite = $this->mediaFavourite->where('user_id',$user_id)->where('media_id',$request->media_id)->first();
            if(empty($mediaFavourite))
            {
                $mediaFavourite = $this->mediaFavourite;
            }
            $mediaFavourite->user_id = $user_id;
            $mediaFavourite->media_id = $request->media_id;
            $mediaFavourite->status = $request->status;
            $mediaFavourite->save();
            return $this->sendResponse($mediaFavourite, 'store media favourite successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }
    
    /**
    * Get favourite media List
    */
    public function getMediaFavouriteList(Request $request)
    {
        try{
            $rule = [
                'type' => 'in:1,2', // 1 = audio, 2 = video
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }
            $favourite_media = $this->mediaLike->where('user_id',auth()->guard('api')->user()->id)->where('status',1)->pluck('media_id','media_id');
            $media_list = $this->media->whereIn('id',$favourite_media)->get();
            if($request->type)
            {
                $media_list = $this->media->whereIn('id',$favourite_media)->where('media_type',$request->type)->get();
            }
            
            $media_list = collect($media_list)->map(function($query) use($request){
                $query->media_thumb_img = !empty($query->media_thumb_img) ? $request->getSchemeAndHttpHost().'/public/'.$query->media_thumb_img : '';
                $query->media = !empty($query->media) ? $request->getSchemeAndHttpHost().'/public/'.$query->media : '';
                $query->like = !empty($query->getMediaLike()) && $query->getMediaLike()->status == '1' ? true : false;
                $query->avg_rating = !empty($query->getMediaReview()->avg('rating')) ? $query->getMediaReview()->avg('rating') : 0;
                $query->review = !empty($query->getMediaReview()) ? $query->getMediaReview() : [];
                return $query;
            });
            return $this->sendResponse($media_list, 'get media list successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Add media view count
     */
    public function mediaViewCount(Request $request)
    {
        try{
            $rule = [
                'media_id' => 'required'
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                return $this->sendError($validator->errors()->first(), 422);
            }

            $user_id = auth()->guard('api')->user()->id;
            $media_id = $request->media_id;
            $addMediaViews = $this->mediaViews;
            $message = "media view added successfully";

            $getMediaViews = $this->mediaViews::where('user_id', $user_id)->where('media_id',$media_id)->first();
            $updateViewCount = 1;
            if(!empty($getMediaViews)){
                $updateViewCount = $getMediaViews->view_count + 1;
                $addMediaViews = $getMediaViews;
                $message = "media view updated successfully";
            }

            $addMediaViews->user_id = $user_id;
            $addMediaViews->media_id = $request->media_id;
            $addMediaViews->view_count = $updateViewCount;
            $addMediaViews->save();

            return $this->sendResponse($addMediaViews, $message);
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  get recent view media
     */
    public function recentViewMedia()
    {
        try{
            $user_id = auth()->guard('api')->user()->id;
            $getMediaViews = $this->mediaViews::where('user_id', $user_id)->orderBy('updated_at', 'DESC')->get();
            return $this->sendResponse($getMediaViews, 'recent view media get successfully');
        }
        catch(Exception $e){
            return $this->sendError('something went wrong', 500);
        }
    }

    /**
     *  Get Recommendation Media
     */
    public function recommendationMedia()
    {
        try{
            $getRecommendationMedia = $this->mediaViews::select('media_id' ,DB::raw('sum(view_count) as totalViewCount'))->groupBy('media_id')->orderBy('totalViewCount', 'DESC')->pluck('media_id', 'media_id');
            $getMedia = $this->media::whereIn('id', $getRecommendationMedia)->get();
            return $this->sendResponse($getMedia, 'recommendation media get successfully');
        }
        catch(Exception $e){
            return $this->sendError('smothing went wrong', 500);
        }
    }
}