<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\StudentModel;

class SitesController extends BaseController
{
    private $studentObject;

    public function __construct(){
        $this->studentObject = new StudentModel();
    }

    /*----------Model Based Query Builder-------------*/
    public function insertStudent(){
        $data = [
            "name" => "nicko cambarihan",
            "email" => "nickocambarihan@gmail.com",
            "phone" => "09123456789",
        ];

        if($this->studentObject->insert($data)){
            echo "Student created successfully!";
        }
        else{
            echo "Student creation failed!";
        }

        
    }

    public function updateStudent(){
        $student_id = 4;

        $updated_data = [
            "phone" => "09987654321",
        ];

        if($this->studentObject->update([
            "id" => $student_id
        ], $updated_data)){
            echo "Student updated successfully!";
        }
        else{
            echo "Student update failed!";
        }

        
    }

    public function deleteStudent(){
        $student_id = 4;

        if($this->studentObject->delete($student_id)){
            echo "Student deleted successfully!";
        }
        else{
            echo "Student deletion failed!";
        }

        
    }

    public function getStudents(){

        //$students = $this->studentObject->findAll(); //Get All
        //$students = $this->studentObject->find(1); //Get by primary id
        $students = $this->studentObject->where([
            "email" => "jhoberterato@gmail.com"
        ])->get()->getRowArray(); //Get by where

        echo "<pre>";
        print_r($students);
    }


    /*----------App Routes Method-------------*/
    //Get
    public function listStudents(){
        echo json_encode([
            "status" => true,
            "message" => "List Api called"
        ]);
    }

    //Post
    public function saveStudent(){
        echo json_encode([
            "status" => true,
            "message" => "Save Student Api called"
        ]);
    }

    //Put || Patch
    public function editStudent(){
        echo json_encode([
            "status" => true,
            "message" => "Edit Student Api called"
        ]);
    }

    //Delete
    public function removeStudent(){
        echo json_encode([
            "status" => true,
            "message" => "Remove Student Api called"
        ]);
    }

    //Protected Method with protected route
    public function method1(){
        echo "Method 1";
    }

    public function method2(){
        echo "Method 2";
    }

    public function method3(){
        echo "Method 3";
    }

    public function login(){
        $session = session();
        $session->set("isLoggedIn", 1);
    }

    public function logout(){
        $session = session();
        $session->remove("isLoggedIn");
    }

    public function accessDenied(){
        echo "No Permision";
    }
}
