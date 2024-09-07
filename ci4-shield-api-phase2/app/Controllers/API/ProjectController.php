<?php

namespace App\Controllers\API;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProjectModel;

class ProjectController extends ResourceController
{
    //Post
    public function addProject()
    {
        $rules = [
            "name" => "required",
            "budget" => "required"
        ];

        if(!$this->validate($rules)){
            $response = [
                "status" => false,
                "message" => $this->validator->getErrors(),
                "data" => []
            ];
        }else{
            $userId = auth()->id();
            $projectObject = new ProjectModel();

            $name = $this->request->getVar("name");
            $budget = $this->request->getVar("budget");

            $data = [
                "user_id" => $userId,
                "name" => $name,
                "budget" => $budget,
            ];

            if($projectObject->insert($data)){
                $response = [
                    "status" => true,
                    "message" => "Project added successfully",
                    "data" => []
               ];
            }else{
                $response = [
                    "status" => false,
                    "message" => $this->validator->getErrors(),
                    "data" => []
                ];
            }
        }

        return $this->respondCreated($response);
    }

    //Get
    public function listProjects()
    {
        $userId = auth()->id();
        $projectObject = new ProjectModel();

        $projectData = $projectObject->where([
            "user_id" => $userId
        ])->findAll();
        
        if(count($projectData) > 0){
            $response = [
                "status" => true,
                "message" => "Project Data",
                "data" => $projectData
            ];
        }
        else{
            $response = [
                "status" => false,
                "message" => "No Data",
                "data" => []
            ];
        }
        

        return $this->respondCreated($response);
    }

    //Delete
    public function deleteProject($project_id)
    {
        
        if(!empty($project_id)){
            $userId = auth()->id();
            $projectObject = new ProjectModel();
            $projectData = $projectObject->where([
                "id" => $project_id,
                "user_id" => $userId
            ])->first();

            if(!empty($projectData)){
                if($projectObject->delete($project_id)){
                    $response = [
                        "status" => true,
                        "message" => "Project deleted successfully",
                        "data" => []
                    ];
                }
                else{
                    $response = [
                        "status" => false,
                        "message" => "Failed to delete project",
                        "data" => []
                    ];
                }
            }
            else{
                $response = [
                    "status" => false,
                    "message" => "Project not found",
                    "data" => []
                ];
            }
        }
        else{
            $response = [
                "status" => false,
                "message" => "Project ID is required",
                "data" => []
            ];
        }

        return $this->respondCreated($response);
    }
}
