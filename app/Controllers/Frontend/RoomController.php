<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\RoomCategory;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\Reservation;
use App\Models\User;
use CodeIgniter\I18n\Time;

class RoomController extends BaseController
{
    private $categoryModel, $roomModel, $roomImageModel, $reservationModel, $userModel;

    public function __construct(){
        $this->categoryModel = new RoomCategory();
        $this->roomModel = new Room();
        $this->roomImageModel = new RoomImage();
        $this->reservationModel = new Reservation();
        $this->userModel = new User();
    }

    public function index()
    {
        $categories = $this->categoryModel->findAll();
        $rooms = $this->roomModel->join('room_categories','room_categories.id = rooms.room_category_id')
            ->select([
                'rooms.id',
                'rooms.name',
                'rooms.slug',
                'rooms.num_person',
                'room_categories.name as category',
            ])
            ->findAll();

        $image_array = [];

        foreach($rooms as $room){
            $room_image = $this->roomImageModel->where('room_id',$room['id'])->first()['image_name'];

            $image_array['img'][] = $room_image;
        }

        return view('frontend/pages/rooms/index',[
            'category' => null,
            'categories' => $categories,
            'rooms' => $rooms,
            'image_array' => $image_array
        ]);
    }
    public function filterCategory($category_id)
    {
        $category = $this->categoryModel->find($category_id);
        $categories = $this->categoryModel->findAll();
        $rooms = $this->roomModel->join('room_categories','room_categories.id = rooms.room_category_id')
            ->select([
                'rooms.id',
                'rooms.name',
                'rooms.slug',
                'rooms.num_person',
                'room_categories.name as category',
            ])
            ->where('rooms.room_category_id',$category['id'])->findAll();

        $image_array = [];

        foreach($rooms as $room){
            $room_image = $this->roomImageModel->where('room_id',$room['id'])->first()['image_name'];

            $image_array['img'][] = $room_image;
        }

        return view('frontend/pages/rooms/index',[
            'category' => $category,
            'categories' => $categories,
            'rooms' => $rooms,
            'image_array' => $image_array
        ]);
    }

    public function roomDetail($slug){
        $room = $this->roomModel->join('room_categories','room_categories.id = rooms.room_category_id')
            ->select([
                'rooms.id',
                'rooms.name',
                'rooms.slug',
                'rooms.num_person',
                'rooms.description',
                'room_categories.name as category',
            ])->where('slug', $slug)->first();

        $images = $this->roomImageModel->where('room_id',$room['id'])->findAll();

        $today = Time::today('Asia/Jakarta')->toDateTimeString();

        $reservations = $this->reservationModel->join('rooms', 'rooms.id=reservations.room_id')
            ->join('users', 'users.id=reservations.user_id')
            ->select([
                'reservations.*', 'rooms.name as room_name', 'users.name as user_name'
            ])->where('reservations.created_at >=',$today)
            ->where('rooms.id',$room['id'])->findAll();

        return view('frontend/pages/rooms/detail',[
            'room' => $room,
            'reservations'=>$reservations,
            'images' => $images
        ]);
    }

    public function book(){
        $this->reservationModel->save([
            'room_id' => $this->request->getVar('room_id'),
            'user_id' => session()->get('user_id'),
            'time_start' => $this->request->getVar('time_start'),
            'time_end' => $this->request->getVar('time_end'),
            'status' => 'booked'
        ]);

        return redirect()->to('/rooms/detail/'.$this->request->getVar('slug'))->with('success','Booked Successfully');
    }
    
}
