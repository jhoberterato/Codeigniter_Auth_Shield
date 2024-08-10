<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StudentsController extends BaseController
{
    private $db;
    private $table;

    public function __construct(){
        $this->db = db_connect();
        $this->table = $this->db->table("students");
    }

    public function insertStudent()
    {
        $data = [
            "name" => "marivic villareal",
            "email" => "marivicvillareal@gmail.com",
            "phone" => "09501658928"
        ];

        if($this->table->insert($data)){
            echo "Student created successfully!";
        }
        else{
            echo "Student creation failed!";
        }
    }

    public function updateStudent()
    {
        $update_data = [
            "phone" => "09070815150"
        ];

        if($this->table->update($update_data, [
            "id" => 1
        ])){
            echo "Student updated successfully!";
        }
        else{
            echo "Student update failed!";
        }
    }
}
