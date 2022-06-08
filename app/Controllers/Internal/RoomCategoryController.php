<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\RoomCategory;

class RoomCategoryController extends BaseController
{
    protected $roomCategoryModel;

    public function __construct(){
        $this->roomCategoryModel = new RoomCategory();
    }

    public function index()
    {
        $room_categories = $this->roomCategoryModel->findAll();
        return view('backend/pages/room_categories/index',[
            'room_categories' => $room_categories
        ]);
    }

    public function create(){
            return view('backend/pages/room_categories/create',[
                'validation'=>\Config\Services::validation()
            ]);
    }

    public function store(){
        if (! $this->validate([
            'name' => [
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Category name cannot be empty'
                ]
            ],
        ])){
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/room_categories/create')->withInput()->with('validation',$validation);
        }
        $file=$this->request->getFile('images');
        if($file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/category_images/', $filename);
            $this->roomCategoryModel->save([
                'name' => $this->request->getVar('name'),
                'images' => $filename
            ]);
        }

        return redirect()->to('internal/room_categories')->with('success','Data Added Successfully');
    }

    public function edit($id){
        $room_category = $this->roomCategoryModel->find($id);
        return view('backend/pages/room_categories/edit',[
            'room_category'=>$room_category,
            'validation'=>\Config\Services::validation()
        ]);
    }

    public function update($id){
        if (! $this->validate([
            'name' => [
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Category name cannot be empty'
                ]
            ],
        ])){
            $validation =  \Config\Services::validation();
            return redirect()->to('internal/room_categories/edit/'.$id)->withInput()->with('validation',$validation);
        }
        $data = ['name'=> $this->request->getVar('name')];
        $category = $this->roomCategoryModel->find($id);

        $file=$this->request->getFile('images');
        if($file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $data['images'] = $filename;
            if($category['images'] != null){
                unlink('uploads/category_images/'.$category['images']);
            }
            $file->move('uploads/category_images/', $filename);
        }

        $this->roomCategoryModel->update($id,$data);

        return redirect()->to('internal/room_categories')->with('success','Data Updated Successfully');
    }

    public function delete($id){
        $category = $this->roomCategoryModel->find($id);

        if($category){
            $this->roomCategoryModel->delete($id);
        }

        return redirect()->back()->with('success','Data Deleted Successfully');
    }
}
