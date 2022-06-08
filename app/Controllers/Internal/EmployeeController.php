<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\Employee;

class EmployeeController extends BaseController
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new Employee();
    }
    public function index()
    {
        $employees = $this->employeeModel->findAll();
        return view('backend/pages/employees/index', [
            'employees' => $employees
        ]);
    }
    public function create()
    {
        $employees = $this->employeeModel->findAll();
        return view('backend/pages/employees/create', [
            'validation' => \Config\Services::validation()
        ]);
    }
    public function store()
    {
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Employee name cannot be empty'
                ]
            ],
            'Jobdesk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jobdesk cannot be empty'
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
            return redirect()->to('internal/employees/create')->withInput()->with('validation', $validation);
        }

        $file = $this->request->getFile('avatar');
        if ($file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads/avatar_users/', $filename);
            $this->employeeModel->save([
                'name' => $this->request->getVar('name'),
                'Jobdesk' => $this->request->getVar('Jobdesk'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'phone_number' => $this->request->getVar('phone_number'),
                'avatar' => $filename
            ]);
        }
        return redirect()->to('internal/employees')->with('success', 'Data Added Successfully');
    }
    public function edit($id)
    {
        $employee = $this->employeeModel->find($id);
        return view('backend/pages/employees/edit', [
            'employee' => $employee,
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
            'Jobdesk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jobdesk cannot be empty'
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
            return redirect()->to('internal/employees/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $file = $this->request->getFile('avatar');
        $employee = $this->employeeModel->find($id);
        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password') ? password_hash($this->request->getVar('password'), PASSWORD_DEFAULT) : $employee['password'],
            'phone_number' => $this->request->getVar('phone_number')
        ];

        if ($file) {
            if ($file->isValid() && !$file->hasMoved()) {

                $filename = $file->getRandomName();
                $data['avatar'] = $filename;
                unlink('uploads/avatar_users/' . $employee['avatar']);
                $file->move('uploads/avatar_users/', $filename);
            }
        }
        $this->employeeModel->update($id, $data);

        return redirect()->to('internal/employees')->with('success', 'Data Updated Successfully');
    }

    public function delete($id)
    {
        $employee = $this->employeeModel->find($id);

        if ($employee) {
            //            unlink('uploads/avatar_users/'.$user['avatar']);
            $this->employeeModel->delete($id);
        }

        return redirect()->back()->with('success', 'User Deleted Successfully');
    }
}
