<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Users;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Quiz;
use App\Models\SiteBG;

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
     * @var Quiz;
     */
    public $quiz;

    /**
     * @var SiteBG;
     */
    public $siteBG;
    
    // consstruct controller
    public function __construct()
    {
        $this->users = new Users();
        $this->category = new Category();
        $this->subCategory = new SubCategory();
        $this->quiz = new Quiz();
        $this->siteBG = new SiteBG();
    }

}
