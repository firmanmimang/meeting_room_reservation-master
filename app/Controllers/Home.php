<?php

namespace App\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomImage;

class Home extends BaseController
{
    protected $roomImageModel, $roomModel, $roomCategoryModel;

    public function __construct(){
        $this->roomImageModel = new RoomImage();
        $this->roomModel = new Room();
        $this->roomCategoryModel = new RoomCategory();
    }
    public function index()
    {
//        $rooms = $this->roomModel->findAll();
//        $room_categories = $this->roomCategoryModel->findAll();
//        $room_images = $this->roomImageModel->findAll();
//        return view('backend/dashboard',[
//            'rooms'=>count($rooms),
//            'room_categories'=>count($room_categories),
//            'room_images'=>count($room_images),
//        ]);

        return view('frontend/pages/index');
    }
}
