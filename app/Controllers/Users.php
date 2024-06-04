<?php

namespace App\Controllers;

use App\Models\ResumeModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

use ReflectionException;

class Users extends BaseController
{


    public function get_user_mobile($mobile)
    {
        $model = new UserModel();
        $data = $model->findUserByUserName($mobile);

        if ($data == null) {
            $response =
                $this->response->setStatusCode(200)->setBody(' No Data found');
            return $response;
        } else {
            return $this
                ->getResponse(
                    [
                        'message' => 'Data found successfully ',
                        'data' => $data

                    ]
                );
        }
    }
    public function get_user($id)
    {
        $model = new UserModel();
      
        $data = $model->findUserById($id);
       
       
        if ($data == null) {
            $response =
                $this->response->setStatusCode(200)->setBody(' No Data found');
            return $response;
        } else {
            return $this
                ->getResponse(
                    [
                        'message' => 'Data found successfully ',
                        'data' => $data,
                        'status' => 'success'

                    ]
                );
        }
    }
    public function get_id($id)
    {
        $model = new UserModel();
        $data = $model->get_data_id($id);

        if ($data == null) {
            $response =
                $this->response->setStatusCode(200)->setBody(' No Data found');
            return $response;
        } else {
            return $this
                ->getResponse(
                    [
                        'message' => 'Data found successfully ',
                        'data' => $data,
                        'status' => 'success'

                    ]
                );
        }
    }
    // work experience
   
    
    public function user_del($id)
    {
        // echo $id;
        try {
            $model = new UserModel();
            // $post = $model->findPostById($id);
            $model->delete_usweb($id);
            return redirect()->to('user-list');
        } catch (Exception $exception) {
            return redirect()->to('user-list')->with('error', 'Failed to delete the post.');
        }
    }
    public function get()
    {
        $model = new UserModel();
        $data = $model->get_data();

        if ($data == null) {
            $response =
                $this->response->setStatusCode(200)->setBody(' No Data found');
            return $response;
        } else {
            return $this
                ->getResponse(
                    [
                        'message' => 'Data found successfully ',
                        'data' => $data,
                        'status' => 'success'

                    ]
                );
        }
    }
  

}
