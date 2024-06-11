<?php

namespace App\Controllers;

use App\Models\PriceModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use \DateTime;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Session\Session;
use ReflectionException;

class Price extends BaseController
{
    use ResponseTrait;
    protected $session;
   
    public function index()
    {
        //    echo "test";
        //    die();

        $model = new PriceModel();
        $post = $model->findAll();
        return $this->getResponse(
            [
                'message' => 'price retrieved successfully',
                'post' => $post,
                'status' => 'success'
            ]
        );
    }

    
    public function show($id)
    {
        // user_id pass
        try {
            $model = new PriceModel();
            $post = $model->findpriceById($id);

           

            return $this->getResponse(
                [
                    'message' => 'Price retrieved successfully',
                    'Job' => $post,
                   
                    'status' => 'success'
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => 'Could not find price for specified ID'
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
 

    public function update($id)
    {
        try {
            $model = new PriceModel();
            $input = $this->getRequestInput($this->request);
            $model->update1($id, $input);
            $post = $model->findpriceById($id);
            return $this->getResponse(
                [
                    'message' => 'price  updaetd successfully',
                    'job' => $post,
                    'status' => 'success'
                ]
            );
        } catch (Exception $exception) {
            return $this->getResponse(
                [
                    'message' => $exception->getMessage(),
                    'status' => 'error',
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
   
    public function destroy($id)
    {
        try {
            $model = new PriceModel();
            $model->deletedata($id);
            return $this
                ->getResponse(
                    [
                        'message' => 'price deleted successfully',
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

