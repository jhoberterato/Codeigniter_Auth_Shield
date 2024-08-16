<?php

namespace App\Controllers\API;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\StudentModel;

class APIController extends ResourceController
{
    //POST
    public function addStudent(){
       
        $rules = [
            "name" => "required",
            "email" => "required|valid_email|is_unique[students.email]",
        ];

        if(!$this->validate($rules)){
            $response = [
                "status" => false,
                "message" => $this->validator->getErrors(),
                "data" => []
            ];
        }
        else{
            $iamgeFile = $this->request->getFile("profile_image");

            if(isset($iamgeFile) && !empty($iamgeFile)){
                $imageName = $iamgeFile->getName();

                $tempArray = explode(".", $imageName);

                $newImageName = round(microtime(true)).".".end($tempArray);

                if($iamgeFile->move("images", $newImageName)){
                    $studentObject = new StudentModel();
                    $data = [
                        "name" => $this->request->getVar("name"),
                        "email" => $this->request->getVar("email"),
                        "phone" => $this->request->getVar("phone"),
                        "profile_image" => "images/".$newImageName
                    ];

                    if($studentObject->insert($data)){
                        $response = [
                            "status" => true,
                            "message" => "Student save successfully",
                            "data" => []
                        ];
                    }
                    else{
                        $response = [
                            "status" => false,
                            "message" => "Failed to save student",
                            "data" => []
                        ];
                    }
                }
                else{
                    $response = [
                        "status" => false,
                        "message" => "Failed to upload image",
                        "data" => []
                    ];
                }
            }
            else{
                $studentObject = new StudentModel();
                $data = [
                    "name" => $this->request->getVar("name"),
                    "email" => $this->request->getVar("email"),
                    "phone" => $this->request->getVar("phone"),
                ];

                if($studentObject->insert($data)){
                    $response = [
                        "status" => true,
                        "message" => "Student save successfully",
                        "data" => []
                    ];
                }
                else{
                    $response = [
                        "status" => false,
                        "message" => "Failed to save student",
                        "data" => []
                    ];
                }
            }
            
        }

        return $this->respondCreated($response);
    }
    
    //GET
    public function listStudents(){
        $studentObject = new StudentModel();

        $students = $studentObject->findAll();

        if(!empty($students)){
            $response = [
                "status" => true,
                "message" => "Students found",
                "data" => $students,
            ];
        }
        else{
            $response = [
                "status" => false,
                "message" => "No student found",
                "data" => [],
            ];
        }

        return $this->respondCreated($response);
    }

    //GET
    public function studentInfo($student_id){
    
        if(!empty($student_id)){
            $studentObject = new StudentModel();
            $student = $studentObject->find($student_id);
            if(!empty($student)){
                $response = [
                    "status" => true,
                    "message" => "Students found",
                    "data" => $student,
                ];
            }
            else{
                $response = [
                    "status" => false,
                    "message" => "No student found",
                    "data" => [],
                ];
            }
        }
        else{
            $response = [
                "status" => false,
                "message" => "Student ID is required",
                "data" => [],
            ];
        }
        

        return $this->respondCreated($response);
    }

    //PUT
    public function updateStudent($student_id){
        
        $studentObject = new StudentModel();
        $student = $studentObject->find($student_id);

        if(!empty($student)){

            //Check for new name value
            $name = $this->request->getVar("name");
            if(isset($name) && !empty($name)){
                $student['name'] = $name;
            }

            //Check for new email value
            $email = $this->request->getVar("email");
            if(isset($email) && !empty($email)){
                $student['email'] = $email;
            }

            //Check for new phone value
            $phone = $this->request->getVar("phone");
            if(isset($phone) && !empty($phone)){
                $student['phone'] = $phone;
            }

            //Check for new profile_image value
            $imageFile = $this->request->getFile("profile_image");
            if(!empty($imageFile)){
                $imageName = $imageFile->getName();

                $imageArrays = explode(".", $imageName);
                $newImageName = round(microtime(true)).".".end($imageArrays);

                if($imageFile->move("images", $newImageName)){
                    $student['profile_image'] = $newImageName;
                }
                else{
                    $response = [
                        "status" => false,
                        "message" => "Failed to upload profile image",
                        "data" => [],
                    ];
                }
            }
            
            if($studentObject->update($student_id, $student)){
                $response = [
                    "status" => true,
                    "message" => "Student updated successfully",
                    "data" => [],
                ];
            }
            else{
                $response = [
                    "status" => false,
                    "message" => "Failed to update student",
                    "data" => [],
                ];
            }
        }
        else{
            $response = [
                "status" => false,
                "message" => "No student found",
                "data" => [],
            ];
        }

        return $this->respondCreated($response);
    }

    //DELETE
    public function deleteStudent($student_id){
        
    }
}
