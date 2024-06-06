<?php

namespace App\Controllers;

use App\Models\ProfileModel;


use App\Models\BasicModel;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use CodeIgniter\API\ResponseTrait;
use ReflectionException;

class profile_img extends BaseController
{

    public function index()
    {

        $model = new ProfileModel();
        // echo "test";
        // die();
        $post = $model->findAll();
        if (!$post) {
            return $this->getResponse(
                [
                    'message' => 'image not found ',

                ]
            );
        } else {
            return $this->getResponse(
                [
                    'message' => 'Job retrieved successfully',
                    'post' => $post,
                    'status' => 'success'
                ]
            );
        }
    }

    public function store()
    {
        $input = $this->getRequestInput($this->request);


        // Get the uploaded file
        $file = $this->request->getFile('profile_img');


        // Check if the file is uploaded successfully
        if ($file->isValid() && !$file->hasMoved()) {
            // Move the file to the uploads folder
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/profile', $newName);

            // Save file information to the database

            $filename = $file->getName();
            $filepath = '/uploads/profile/' . $newName; // Use the new name for the file path
            $filedata = file_get_contents($file->getTempName());

            // Save file information to the database


            $model = new ProfileModel();
            $existingResume = $model->findByUId($input['user_id']);
            // echo "test";
            // die();
            if ($existingResume == null) {
                // If there's no existing resume, create a new folder for the user
                $userFolder = WRITEPATH . 'uploads/profile/' . $input['user_id'] . '-img';
                if (!file_exists($userFolder)) {
                    mkdir($userFolder, 0777, true); // Create user's folder if it doesn't exist
                }
            } else {


                $existingFilePath = WRITEPATH . $existingResume['image_path'];
                //     If there's an existing resume, delete the previous file and folder
                //     echo "$existingFilePath";
                // die();
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath); // Delete the existing file
                } else {
                    echo "File not exists";
                }
            }


            // Move the file to the user's folder
            $userResumeFolder = WRITEPATH . 'uploads/profile/' . $input['user_id'] . '-img';
            $newResumePath = $userResumeFolder . '/' . $newName;
            rename(WRITEPATH . 'uploads/profile/' . $newName, $newResumePath);
            $res_p = '/uploads/profile/' . $input['user_id'] . '-img/' . $newName;

            $data = [
                'user_id' => $input['user_id'],
                'image_path' => $res_p // Save the file path
                // You can add more information about the file as needed
            ];
            // Update or save the resume information in the database
            if ($existingResume == null) {
                $post = $model->save($data);
            } else {
                $post = $model->update1($data);
            }
// for image path
$id = $input['user_id'];
$post = $model->findByUId($id);
$data['user_id'] = $id;
$baseUrl = base_url(); // Assuming you have configured the base URL in your CodeIgniter configuration
$baseUrl = str_replace('/public/', '/', $baseUrl);

    
    $resume1 = $post['image_path'];
    
    $existingFilePath = WRITEPATH . $resume1;

    if (file_exists($existingFilePath)) {


        $data['image_path'] = $baseUrl . 'writable' . $resume1;
    } else {
        $data['image_path'] = $baseUrl . 'images/user_img.png';
    }



            return $this->getResponse([
                'message' => 'Resume saved successfully',
                'image' => $data['image_path'],
                'status' => 'success'
            ]);
        } else {
            // Handle file upload error
            return "Error uploading file";
        }
    }

    public function show($id)
    {
        // user_id pass
        try {
            $model = new ProfileModel();
            $post = $model->findJobById($id);

            return $this->getResponse(
                [
                    'message' => 'image retrieved successfully',
                    'image' => $post,
                    'status' => 'success'
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find image for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
    public function show_userid($id)
    {
        // user_id pass
        try {
            $model = new ProfileModel();
            $post = $model->findByUId($id);
            $data['user_id'] = $id;
            $baseUrl = base_url(); // Assuming you have configured the base URL in your CodeIgniter configuration
            $baseUrl = str_replace('/public/', '/', $baseUrl);
          
                
                $resume1 = $post['image_path'];
                
                $existingFilePath = WRITEPATH . $resume1;

                if (file_exists($existingFilePath)) {


                    $data['image_path'] = $baseUrl . 'writable' . $resume1;
                } else {
                    $data['image_path'] = $baseUrl . 'images/user_img.png';
                }




            return $this->getResponse(
                [
                    'message' => 'profile image retrieved successfully',
                    'img' => $data,
                    'status' => 'success'
                ]
            );
        } catch (Exception $e) {

            $baseUrl = base_url(); // Assuming you have configured the base URL in your CodeIgniter configuration
           $data['image_path'] =  $baseUrl . 'images/user_img.png';
            return $this->getResponse(
                [
                    'message' => 'Could not find profile image for specified ID',
                    'img' =>  $data,
                    'status' => 'success',
                ],
                
            );
        }
    }


    public function distroy($id)
    {
        try {
            $model = new ProfileModel();
       
            $existingResume = $model->findByUId($id);
            // echo "test";
            // die();
            if ($existingResume == null) {
                // If there's no existing resume, create a new folder for the user
               
            } else {
                $existingFilePath = WRITEPATH . $existingResume['image_path'];
                //     If there's an existing resume, delete the previous file and folder
                //     echo "$existingFilePath";
                // die();
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath); // Delete the existing file
                } else {
                    echo "File not exists";
                }
            }
            $model->deletedata($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'image deleted successfully',
                        'status' => 'success'
                    ]
                );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}

