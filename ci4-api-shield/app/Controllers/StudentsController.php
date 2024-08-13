<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/*-----------Query Builder Methods-----------*/
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
            "name" => "jhobert erato",
            "email" => "jhoberterato@gmail.com",
            "phone" => "09390808842"
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

    public function deleteStudent()
    {

        if($this->table->delete([
            "id" => 1
        ])){
            echo "Student deleted successfully!";
        }
        else{
            echo "Student deletion failed!";
        }
    }

    public function selectStudent()
    {
        /*-----------Returns All by Array-----------*/
        // $students = $this->table->get()->getResult();

        /*-----------Returns with WHERE by Array-----------*/
        // $students = $this->table->where([
        //     "id" => 2
        // ])->get()->getResult();

        /*-----------Returns with WHERE by Single Row-----------*/
        $students = $this->table->where([
            "id" => 2
        ])->get()->getRowArray();
        
        echo "<pre>";
        print_r($students);
    }
}
