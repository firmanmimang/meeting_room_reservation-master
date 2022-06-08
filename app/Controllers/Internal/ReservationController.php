<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomImage;
use App\Models\User;

class ReservationController extends BaseController

{
    protected $roomImageModel, $roomModel, $roomCategoryModel, $reservationModel, $usersModel;

    public function __construct()
    {
        $this->roomImageModel = new RoomImage();
        $this->roomModel = new Room();
        $this->roomCategoryModel = new RoomCategory();
        $this->userModel = new User();
        $this->reservationModel = new Reservation();
    }

    public function index()
    {
           
        //dd(session()->get());
        
            $reservations = $this->reservationModel->join('rooms', 'rooms.id=reservations.room_id')
            ->join('users', 'users.id=reservations.user_id')
            ->select([
                'reservations.*', 'rooms.name as room_name', 'users.name as user_name'
            ])->findAll();
               
                return view('backend/pages/reservations/index', [
                    'reservations' => $reservations
                ]);
    }
}