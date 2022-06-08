<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController

{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new User();
    }
    public function index()
    {
        $users = $this->usersModel->findAll();
        return view('backend/pages/users/index', [
            'users' => $users
        ]);
    }
    public function create()
    {
        return view('backend/pages/users/create', [
            'validation' => \Config\Services::validation()
        ]);
    }
    public function store()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name cannot be empty'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email cannot be empty'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password cannot be empty'
                ]
            ],
            'phone_number' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Phone Number cannot be empty',
                    'numeric' => 'Phone Number must be numeric',
                ]
            ],

        ])) {
            $validation =  \Config\Services::validation();
            //            dd($validation);
            return redirect()->to('internal/users/create')->withInput()->with('validation', $validation);
        }

        $file = $this->request->getFile('avatar');
        if ($file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/avatar_users/', $filename);
            $this->usersModel->save([
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'phone_number' => $this->request->getVar('phone_number'),
                'avatar' => $filename
            ]);
        }

        return redirect()->to('internal/users')->with('success', 'Data Added Successfully');
    }

    public function edit($id)
    {
        $user = $this->usersModel->find($id);
        return view('backend/pages/users/edit', [
            'user' => $user,
            'validation' => \Config\Services::validation()
        ]);
    }


    public function update($id)
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Name cannot be empty'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email cannot be empty'
                ]
            ],

            'phone_number' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Phone Number cannot be empty',
                    'numeric' => 'Phone Number must be numeric',
                ]
            ],

        ])) {
            $validation =  \Config\Services::validation();
            //            dd($validation);
            return redirect()->to('internal/users/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $file = $this->request->getFile('avatar');
        $user = $this->usersModel->find($id);
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password') ? password_hash($this->request->getVar('password'), PASSWORD_DEFAULT) : $user['password'],
            'phone_number' => $this->request->getVar('phone_number')
        ];

        if ($file) {
            if ($file->isValid() && !$file->hasMoved()) {

                $filename = $file->getRandomName();
                $data['avatar'] = $filename;
                unlink('uploads/avatar_users/' . $user['avatar']);
                $file->move('uploads/avatar_users/', $filename);
            }
        }
        $this->usersModel->update($id, $data);

        return redirect()->to('internal/users')->with('success', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $user = $this->usersModel->find($id);

        if ($user) {
            //            unlink('uploads/avatar_users/'.$user['avatar']);
            $this->usersModel->delete($id);
        }

        return redirect()->back()->with('success', 'User Deleted Successfully');
    }
}
