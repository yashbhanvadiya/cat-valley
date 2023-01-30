<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Users;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Notes;
use App\Models\Quiz;
use App\Models\Media;
use App\Models\Quote;
use App\Models\MediaLike;
use App\Models\MediaReview;
use App\Models\MediaFavourite;
use App\Models\MediaViews;
use App\Models\Trainer;
use App\Models\TrainerReview;
use App\Models\Subscription;
use App\Models\CardDetails;
use App\Models\Transaction;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var Users;
     */
    public $users;

    /**
     * @var Category;
     */
    public $category;

    /**
     * @var SubCategory;
     */
    public $subCategory;

    /**
     * @var Notes;
     */
    public $notes;

    /**
     * @var Quiz;
     */
    public $quiz;

    /**
     * @var Media;
     */
    public $media;

    /**
     * @var Quote;
     */
    public $quote;

    /**
     * @var MediaLike;
     */
    public $mediaLike;

    /**
     * @var MediaReview;
     */
    public $mediaReview;

    /**
     * @var MediaFavourite;
     */
    public $mediaFavourite;

    /**
     * @var MediaViews;
     */
    public $mediaViews;

    /**
     * @var Trainer;
     */
    public $trainer;

    /**
     * @var TrainerReview;
     */
    public $trainerReview;

    /**
     * @var Subscription;
     */
    public $subscription;

    /**
     * @var CardDetails;
     */
    public $cardDetails;

    /**
     * @var Transaction;
     */
    public $transaction;

    // consstruct controller
    public function __construct()
    {
        $this->users = new Users();
        $this->category = new Category();
        $this->subCategory = new SubCategory();
        $this->notes = new Notes();
        $this->quiz = new Quiz();
        $this->media = new Media();
        $this->quote = new Quote();
        $this->mediaLike = new MediaLike();
        $this->mediaReview = new MediaReview();
        $this->mediaFavourite = new MediaFavourite();
        $this->mediaViews = new MediaViews();
        $this->trainer = new Trainer();
        $this->trainerReview = new TrainerReview();
        $this->subscription = new Subscription();
        $this->cardDetails = new CardDetails();
        $this->transaction = new Transaction();
    }

    
    /**
     * return success response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'message' => $message,
            'data'    => $result,
        ];

        return response()->json($response, 200);
    }
    
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

}
