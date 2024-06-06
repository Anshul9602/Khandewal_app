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
        $model1 = new ResumeModel();
        $data = $model->findUserById($id);
        $resume = $model1->findByUId($id);
        if ($resume == null) {
            $data['resume'] = 1;
        } else {
            $data['resume'] = 0;
            $data['resume_id'] = $resume['id'];
        }
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
    public function work_ex()
    {
        $input = $this->getRequestInput($this->request);
        // echo "<pre>"; print_r($input); echo "</pre>";
        // die();
        $required_fields = ['user_id', 'organisation', 'designation', 'profile', 'location', 'start_date', 'end_date'];
        foreach ($required_fields as $field) {
            if (!isset($input[$field]) || empty($input[$field])) {
                return "Error: Missing required field '$field'";
            }
        }

        $model = new UserModel();
        // echo 'yes';
        $data = [
            'user_id' => $input['user_id'],
            'organisation' => $input['organisation'],
            'designation' => $input['designation'],
            'ref_mobile' => $input['ref_mob'],
            'ref_email' => $input['ref_email'],
            'profile' => $input['profile'],
            'location' => $input['location'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date']
        ];
        // echo "<pre>";
        //             print_r($data);
        //             echo "</pre>";
        //             die();
        $user1 = $model->save_workex($data);

        if ($user1 == true) {
            return $this
                ->getResponse(
                    [
                        'message' => 'User Work experience add successfully',
                        'user' => $data,
                        'status' => 'success'


                    ]
                );
        } else {

            $response =
                $this->response->setStatusCode(200)->setBody('User Work experience not updated');
            return $response;
        }
    }
    public function work_ex_update($id)
    {

        $input = $this->getRequestInput($this->request);
        // echo "<pre>"; print_r($input); echo "</pre>";
        // die();
        $required_fields = ['organisation', 'designation', 'profile', 'location', 'start_date', 'end_date'];
        foreach ($required_fields as $field) {
            if (!isset($input[$field]) || empty($input[$field])) {
                return "Error: Missing required field '$field'";
            }
        }
        $model = new UserModel();
        $data = [

            'id' => $id,
            'user_id' => $input['user_id'],
            'organisation' => $input['organisation'],
            'designation' => $input['designation'],
            'ref_mobile' => $input['ref_mob'],
            'ref_email' => $input['ref_email'],
            'profile' => $input['profile'],
            'location' => $input['location'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date']
        ];
        // echo "<pre>";
        //             print_r($data);
        //             echo "</pre>";
        //             die();
        $user1 = $model->update_workex($data);

        if ($user1 == true) {
            return $this
                ->getResponse(
                    [
                        'message' => 'User Work experience add successfully',
                        'user' => $data,
                        'status' => 'success'


                    ]
                );
        } else {

            $response =
                $this->response->setStatusCode(200)->setBody('User Work experience not updated');
            return $response;
        }
    }
    public function work_ex_up($id)
    {

        $input = $this->getRequestInput($this->request);
        // echo "<pre>"; print_r($input); echo "</pre>";

        $model = new UserModel();
        $data = [
            'user_id' => $id,
            'work_ex' => $input['work_ex'],

        ];
        // echo "<pre>";
        //             print_r($data);
        //             echo "</pre>";
        //             die();
        $user1 = $model->update_workex_up($data);

        if ($user1 == true) {
            return $this
                ->getResponse(
                    [
                        'message' => 'User Work experience add successfully',
                        'user' => $data,
                        'status' => 'success'


                    ]
                );
        } else {

            $response =
                $this->response->setStatusCode(200)->setBody('User Work experience not updated');
            return $response;
        }
    }
    public function status_e_update($id)
    {
        $model = new UserModel();

        $user1 = $model->update_status_e($id);

        if ($user1 == true) {

            return redirect()->to('user-list');
        } else {

            $response =
                $this->response->setStatusCode(200)->setBody('User status not updated');
            return $response;
        }
    }
    public function status_d_update($id)
    {
        $model = new UserModel();
        $user1 = $model->update_status_d($id);

        if ($user1 == true) {
            return redirect()->to('user-list');
        } else {

            $response =
                $this->response->setStatusCode(200)->setBody('User status not updated');
            return $response;
        }
    }

    public function work_show($id)
    {
        $model = new UserModel();
        $data = $model->getby_id_data($id);
        if ($data == null) {
            $response =
                $this->response->setStatusCode(200)->setBody(' Id Not found');
            return $response;
        } else {
            return $this
                ->getResponse(
                    [
                        'message' => 'Id found successfully ',
                        'data' => $data,
                        'status' => 'success'

                    ]
                );
        }
    }
    public function destroy($id)
    {
        try {
            $model = new UserModel();
            $post = $model->findPostById($id);
            $model->delete($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'Post deleted successfully',
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
    public function delete_w_ex($id)
    {
        try {
            $model = new UserModel();
            // $post = $model->findPostById($id);
            $model->delete_w_ex($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'work exp. deleted successfully',
                        'status' => 'success',
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



    // education
    public function edu_get()
    {
        $model = new UserModel();
        $data = $model->getUserEd();

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
    public function edu_get_id($id)
    {
        $model = new UserModel();
        $data = $model->edu_get_data_id($id);

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
    public function education()
    {
        $input = $this->getRequestInput($this->request);
        // echo "<pre>"; print_r($input); echo "</pre>";
        // die();
        $required_fields = ['user_id', 'ten_th', 'to_th', 'gra_dip', 'post_gra', 'doc', 'hotel_de'];
        foreach ($required_fields as $field) {
            if (!isset($input[$field]) || empty($input[$field])) {
                return "Error: Missing required field '$field'";
            }
        }

        $model = new UserModel();

        $usera = $model->getUserEd_id($input['user_id']);

        // print_r($usera);
        //     die();
        if ($usera) {

            $user1 = $this->education_update($input);
        } else {

            $user1 = $model->save_edu($input);
        }


        if ($user1 == true) {
            return $this
                ->getResponse(
                    [
                        'message' => 'User education add successfully',

                        'status' => 'success'


                    ]
                );
        } else {

            $response =
                $this->response->setStatusCode(200)->setBody('User education not Added');
            return $response;
        }
    }
    public function education_update($input1)
    {

        $input = $input1;
        // echo "<pre>"; print_r($input); echo "</pre>";
        // die();

        $model = new UserModel();

        // echo "<pre>";
        //             print_r($data);
        //             echo "</pre>";
        //             die();
        $user1 = $model->save_edu_up($input);

        if ($user1 == true) {
            return $this
                ->getResponse(
                    [
                        'message' => 'User Work experience add successfully',

                        'status' => 'success'


                    ]
                );
        } else {

            $response =
                $this->response->setStatusCode(200)->setBody('User Work experience not updated');
            return $response;
        }
    }

    public function education_show($id)
    {
        $model = new UserModel();
        $data = $model->getUserEd_id($id);
        if ($data == null) {
            $response =
                $this->response->setStatusCode(200)->setBody(' Id Not found');
            return $response;
        } else {
            return $this
                ->getResponse(
                    [
                        'message' => 'Id found successfully ',
                        'data' => $data,
                        'status' => 'success'
                    ]
                );
        }
    }
    public function delete_education($id)
    {
        try {
            $model = new UserModel();
            // $post = $model->findPostById($id);
            $model->delete_edu($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'education. deleted successfully',
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
    //display data w/o id


}

