<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\Room;
use App\Models\RoomImage;

class RoomImageController extends BaseController
{
    protected $roomImageModel, $roomModel;

    public function __construct(){
        $this->roomImageModel = new RoomImage();
        $this->roomModel = new Room();
    }

    public function index()
    {
        $rooms = $this->roomModel->findAll();

        return view('backend/pages/room_images/index',[
           'rooms'=>$rooms
        ]);
    }

    public function create(){
        $rooms = $this->roomModel->findAll();

        return view('backend/pages/room_images/create',[
            'rooms'=>$rooms,
            'validation'=>\Config\Services::validation()
        ]);
    }

    public function store(){
        $files = $this->request->getFileMultiple('images');

        foreach($files as $file) {
            if($file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                $file->move('uploads/room_images/', $filename);

                $this->roomImageModel->save([
                    'room_id' => $this->request->getVar('room_id'),
                    'image_name' => $filename
                ]);
            }
        }

        return redirect()->to('internal/room_images')->with('success','Data Added Successfully');
    }

    public function show($id){
        $room = $this->roomModel->find($id);
        $images = $this->roomImageModel->where('room_id',$id)->findAll();

//        dd($images);
        return view('backend/pages/room_images/show',[
            'images'=>$images,
            'room'=>$room
        ]);
    }

    public function edit($id){
        $rooms = $this->roomModel->findAll();
        $room = $this->roomModel->where('id',$id)->select('id')->first();
        $room_images = $this->roomImageModel->where('room_id',$id)->findAll();

        return view('backend/pages/room_images/edit',[
            'rooms'=>$rooms,
            'validation'=>\Config\Services::validation(),
            'room_images'=>$room_images,
            'room'=>$room
        ]);
    }

    public function deleteImageById($id){
        $image = $this->roomImageModel->find($id);

        if($image){
            unlink('uploads/room_images/'.$image['image_name']);
            $this->roomImageModel->delete($id);
        }

        return redirect()->back()->with('success','Image Deleted Successfully');
    }

    public function deleteAllImages($id){
        $images = $this->roomImageModel->where('room_id',$id)->findAll();

        if(count($images) > 0){
            foreach($images as $image){
                unlink('uploads/room_images/'.$image['image_name']);
                $this->roomImageModel->delete($image['id']);
            }
            $alert = [
                "type" => "success",
                "alert" => "Images Deleted Successfully"
            ];
        }else{
            $alert = [
                "type" => "danger",
                "alert" => "No Images to Delete"
            ];
        }

        return redirect()->back()->with($alert['type'],$alert['alert']);
    }
}
