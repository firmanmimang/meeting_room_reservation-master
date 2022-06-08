<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\Employee;

class AuthController extends BaseController
{
    protected $employeeModel;

    public function __construct(){
        $this->employeeModel = new Employee();
    }

    public function getSignIn(){
        $session = session();
        if($session->get('email')){
            return redirect()->to('/internal/dashboard');
        }
        return view('backend/auth/signin',[
            'validation'=>\Config\Services::validation()
        ]);
    }

    public function postSignIn(){
        if (! $this->validate([
            'email' => [
                'rules'=>'required|valid_email',
                'errors'=>[
                    'required'=>'Email cannot be empty',
                    'valid_email' => 'Email does not contain a valid email address.'
                ]
            ],
            'password' => [
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Password cannot be empty',
                ]
            ]
        ])){
            $validation =  \Config\Services::validation();
//            dd($validation);
            return redirect()->to('/internal/signin')->withInput()->with('validation',$validation);
        }
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $this->employeeModel->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data['id'],
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'avatar'    => $data['avatar'],
                    'logged_in'=> TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/internal/dashboard');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/internal/signin');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/internal/signin');
        }
    }

    public function getSignout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/internal/signin');
    }
}
