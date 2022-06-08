<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\RoomCategory;

class HomePageController extends BaseController
{
    protected $categoryModel;

    public function __construct(){
        $this->categoryModel = new RoomCategory();
    }

    public function index()
    {
//        dd(session()->get());
        $categories = $this->categoryModel->findAll();
        return view('frontend/pages/index',[
            'categories' => $categories
        ]);
    }
}
