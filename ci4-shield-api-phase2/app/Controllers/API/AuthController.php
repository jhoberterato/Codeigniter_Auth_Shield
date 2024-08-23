<?php

namespace App\Controllers\API;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Shield\Models\UserModel;

class AuthController extends ResourceController
{
   //Post
   public function register()
   {
        $rules = [
            "username" => "required|is_unique[users]",
            "email" => "required",
            "password" => "required"
        ];
   }

   //Post
   public function login()
   {
        //Use: Login specific user
        //Generates token value
   }

   //Get
   public function profile()
   {
        //Use: To get profile data of logged in user
   }

   //Get
   public function logout()
   {
        //Use: Logout user
        //Destroy token
   }
}
