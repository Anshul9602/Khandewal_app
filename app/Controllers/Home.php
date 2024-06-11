<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\PriceModel;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \Datetime;
use CodeIgniter\Session\Session;
use ReflectionException;

class Home extends BaseController
{
    protected $session;
    public function index()
    {
        $isLoggedIn = $this->session->get('login');

        // If 'login' variable is not set or is not equal to 1, redirect to the login page
        if (!$isLoggedIn || $isLoggedIn != 1) {
            return redirect()->to('/');
        }

        // 'login' session variable is set to 1, so continue to load the home page
        // You can add any other logic here if needed

        $model = new UserModel();

        $data['users'] = $model->getAllUserData();
        //    print_r($data['users'][0]);
        //     die();
        // echo "test";
        // die();
        echo view('header');

        // Load main view with data
        echo view('user_list', $data);

        // Load footer view
        echo view('footer');
    }
    public function hotel_list()
    {
        $isLoggedIn = $this->session->get('login');

        // If 'login' variable is not set or is not equal to 1, redirect to the login page
        if (!$isLoggedIn || $isLoggedIn != 1) {
            return redirect()->to('/');
        }

        $model = new PriceModel();

        $data['users'] = $model->findAll();
        //    print_r($data['users']);
        //   die();
        // echo "test";
    
        echo view('header');
        echo view('Hotel_list', $data);
        echo view('footer');
    }
    public function update_price()
    {
        $model = new PriceModel();
        $input = $this->getRequestInput($this->request);
        $id = $input['id'];
    
        $data = $model->update1($id, $input);
    
        if ($data == null) {
            // Set a flashdata message for error
            $this->session->setFlashdata('error', 'Failed to update price.');
        } else {
            // Set a flashdata message for success
            $this->session->setFlashdata('success', 'price updated successfully.');
        }
    
        // Redirect to the price list
        return redirect()->to('price-list');
    }
    public function user_list()
    {
        $isLoggedIn = $this->session->get('login');

        // If 'login' variable is not set or is not equal to 1, redirect to the login page
        if (!$isLoggedIn || $isLoggedIn != 1) {
            return redirect()->to('/');
        }

        // 'login' session variable is set to 1, so continue to load the home page
        // You can add any other logic here if needed

        $model = new UserModel();

        $data['users'] = $model->getAllUserData();
        //    print_r($data['users'][0]);
        //     die();
        // echo "test";
        // die();
        echo view('header');

        // Load main view with data
        echo view('user_list', $data);

        // Load footer view
        echo view('footer');
    }
    public function admin_register()
    {
        $input = $this->getRequestInput($this->request);
        $model1 = new AdminModel();
        $user = $model1->findAdmin($input['email']);
        if ($user == null) {
            $data = [

                'email' => $input['email'],

                'pass' => password_hash($input['pass'], PASSWORD_DEFAULT),
            ];

            $user_admin = $model1->save($data);
            if ($user_admin) {
                $response = $this->response->setStatusCode(200)->setBody(' register');
                return  $response;
            } else {
                $response = $this->response->setStatusCode(400)->setBody('user not registered');
                return  $response;
            }
        } else {
            $user_admin = null;
            $response = $this->response->setStatusCode(400)->setBody('user allrady in list');
            return  $response;
        }
    }
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function authenticate()
    {
        // Handle form submission and authentication
        $input = $this->getRequestInput($this->request);

        $model1 = new AdminModel();
        $user = $model1->findAdmin($input['email']);

        if ($user) {
            $rules = [
                'pin' => 'required|min_length[4]|max_length[4]|validateUser[user_number, pin]'
            ];

            $errors = [
                'pin' => [
                    'validateUser' => 'Invalid login credentials provided'
                ]
            ];

            if ($this->validateRequest1($input, $rules, $errors)) {
                // Authentication successful, set session variable
                $this->session->set('login', 1);
                return redirect()->to('home');
            } else {
                // PIN validation failed, redirect back to login with error message
                return redirect()->to('/')->with('error', 'Invalid PIN');
            }
        } else {
            // User not found, redirect back to login with error message
            return redirect()->to('/')->with('error', 'Invalid email or password');
        }
    }
    public function login()
    {
        $model = new UserModel();
        // $userCount = $this->$model->getUserCount();

        // echo "Total number of users: " . $userCount;

        return view('login');
    }
    public function logout()
    {
        // Unset or set the 'login' session variable to null
        $this->session->remove('login');

        // Redirect the user to the login page
        return redirect()->to('/');
    }

    // public function get()
    // {

    //     return ('welcome_message');
    // }
}
