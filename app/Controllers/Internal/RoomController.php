<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\Room;
use App\Models\RoomCategory;

class RoomController extends BaseController
{
    protected $roomModel,$roomCategoryModel;

    public function __construct(){
        $this->roomModel = new Room();
        $this->roomCategoryModel = new RoomCategory();
    }

    public function index()
    {
        $rooms = $this->roomModel->join('room_categories','room_categories.id = rooms.room_category_id')
            ->select([
                'rooms.id',
                'rooms.name as room_name',
                'rooms.description',
                'rooms.num_person',
                'rooms.slug',
                'room_categories.name as category_name'
            ])->findAll();

        return view('backend/pages/rooms/index',[
            'rooms'=>$rooms
        ]);
    }

    public function create(){
        $categories = $this->roomCategoryModel->findAll();
        return view('backend/pages/rooms/create',[
            'categories'=>$categories,
            'validation'=>\Config\Services::validation()
        ]);
    }

    public function store(){

        if (! $this->validate([
            'name' => [
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Room name cannot be empty'
                ]
            ],
            'num_person' => [
                'rules'=>'required|numeric',
                'errors'=>[
                    'required'=>'Num of person cannot be empty',
                    'numeric'=>'Num of person must a numeric'
                ]
            ],
            'description' => [
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Description cannot be empty'
                ]
            ],

        ])){
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/rooms/create')->withInput()->with('validation',$validation);
        }
        $categorysmall = $this->roomCategoryModel->where('name','Small')->first();
        $categorymedium = $this->roomCategoryModel->where('name','Medium')->first();
        $categorylarge = $this->roomCategoryModel->where('name','Large')->first();
        if ($this->request->getVar('num_person') <=10)
            {
                $roomcategory = $categorysmall['id'];
            }
        elseif ($this->request->getVar('num_person') >10 && $this->request->getVar('num_person') <=15)
            {
                $roomcategory = $categorymedium['id'];
            }
        else {
            $roomcategory = $categorylarge['id'];
        }
        $slug = url_title($this->request->getVar('name'),'-',true);
        $this->roomModel->save([
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'description' => $this->request->getVar('description'),
            'num_person' => $this->request->getVar('num_person'),
            'room_category_id' => $roomcategory
        ]);

        return redirect()->to('internal/rooms')->with('success','Data Added Successfully');
    }

    public function edit($id){
        $room = $this->roomModel->find($id);
        $categories = $this->roomCategoryModel->findAll();
        return view('backend/pages/rooms/edit',[
            'categories' => $categories,
            'room' => $room,
            'validation'=>\Config\Services::validation()
        ]);
    }

    public function update($id){
        if (! $this->validate([
            'name' => [
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Room name cannot be empty'
                ]
            ],
            'num_person' => [
                'rules'=>'required|numeric',
                'errors'=>[
                    'required'=>'Num of person cannot be empty',
                    'numeric'=>'Num of person must a numeric'
                ]
            ],
            'description' => [
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Description cannot be empty'
                ]
            ],
 
        ])){
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/rooms/edit/'.$id)->withInput()->with('validation',$validation);
        }
        $categorysmall = $this->roomCategoryModel->where('name','Small')->first();
        $categorymedium = $this->roomCategoryModel->where('name','Medium')->first();
        $categorylarge = $this->roomCategoryModel->where('name','Large')->first();
        if ($this->request->getVar('num_person') <=10)
            {
                $roomcategory = $categorysmall['id'];
            }
        elseif ($this->request->getVar('num_person') >10 && $this->request->getVar('num_person') <=15)
            {
                $roomcategory = $categorymedium['id'];
            }
        else {
            $roomcategory = $categorylarge['id'];
        }
        $slug = url_title($this->request->getVar('name'),'-',true);
        $this->roomModel->update($id,[
            'name' => $this->request->getVar('name'),
            'slug' => $slug,
            'description' => $this->request->getVar('description'),
            'num_person' => $this->request->getVar('num_person'),
            'room_category_id' => $roomcategory
        ]);

        return redirect()->to('internal/rooms')->with('success','Data Updated Successfully');
    }

    public function delete($id){
        $room = $this->roomModel->find($id);

        if($room){
            $this->roomModel->delete($id);
        }

        return redirect()->back()->with('success','Data Deleted Successfully');
    }
}
