<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function setRole()
    {
        echo "This is set role method";
    }

    public function updateProfile()
    {
        echo "This is update profile method";
    }

    public function addUser()
    {
        echo "This is add user method";
    }
}
