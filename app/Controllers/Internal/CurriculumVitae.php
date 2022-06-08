<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;

class CurriculumVitae extends BaseController
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
}
