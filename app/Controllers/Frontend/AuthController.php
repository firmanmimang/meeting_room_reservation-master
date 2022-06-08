<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\User;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct(){
        $this->userModel = new User();
    }

    public function signup()
    {
        $this->userModel->save([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'phone_number' => $this->request->getVar('phone_number'),
        ]);

        return redirect()->to('/')->with('message','Signed up successfully');
    }

    public function signin(){
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $this->userModel->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
//            dd($verify_pass);
            if($verify_pass){
                $ses_data = [
                    'user_id'       => $data['id'],
                    'user_name'     => $data['name'],
                    'user_email'    => $data['email'],
                    'user_avatar'    => $data['avatar'],
                    'user_logged_in'=> TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/');
        }
    }

    public function signout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
