<?php

namespace App\Controllers\API;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class AuthController extends ResourceController
{
   //Post
   public function register()
   {
        $rules = [
            "username" => "required|is_unique[users.username]",
            "email" => "required|is_unique[auth_identities.secret]",
            "password" => "required"
        ];

        if(!$this->validate($rules)){
          $response = [
               "status" => false,
               "message" => $this->validator->getErrors(),
               "data" => []
          ];
        }
        else{
          //User Model
          $userObject = new UserModel();

          //User Entity
          $userEntityObject = new User([
               "username" => $this->request->getVar("username"),
               "email" => $this->request->getVar("email"),
               "password" => $this->request->getVar("password")
          ]);
          
          $userObject->save($userEntityObject);

          $response = [
               "status" => true,
               "message" => "User saved successfully",
               "data" => []
          ];
        }

        return $this->respondCreated($response);
   }

   //Post
   public function login()
   {
     if(auth()->loggedIn()){
          auth()->logout();
     }
     
     $rules = [
          "email" => "required|valid_email",
          "password" => "required"
     ];

      if(!$this->validate($rules)){
          $response = [
               "status" => false,
               "message" => $this->validator->getErrors(),
               "data" => []
          ];
      }
      else{
          $credentials = [
               "email" => $this->request->getVar("email"),
               "password" => $this->request->getVar("password"),
          ];

          $loginAttempt = auth()->attempt($credentials);

          if(!$loginAttempt->isOK()){
               $response = [
                    "status" => false,
                    "message" => "Invalid login details",
                    "data" => []
               ];
          }
          else{
               $userObject = new UserModel();
               $userData = $userObject->findById(auth()->id());
               $token = $userData->generateAccessToken("thisIsMySecretKey");
               $auth_token = $token->raw_token;
               $response = [
                    "status" => true,
                    "message" => "Success",
                    "data" => [
                         "token" => $auth_token
                    ]
               ];
          }

          return $this->respondCreated($response);
      }
   }

   //Get
   public function profile()
   {
        $userId = auth()->id();
        $userObject = new UserModel();
        $userData = $userObject->findById($userId);  

        return $this->respondCreated([
          "status" => true,
          "message" => "success",
          "data" => [
               "user" => $userData
          ]
        ]);
   }

   //Get
   public function logout()
   {
          auth()->logout();
          auth()->user()->revokeAllAccessTokens();

          return $this->respondCreated([
               "status" => true,
               "message" => "Users logout successfully",
               "data" => []
          ]);
   }

   public function accessDenied(){
     return $this->respondCreated([
          "status" => true,
          "message" => "Invalid access",
          "data" => []
          ]);
   }
}
