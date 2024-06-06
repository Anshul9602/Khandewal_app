<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class JobModel extends Model
{
    protected $table = 'job_listings';

    protected $allowedFields = [
        'mobile_number',

    ];
    protected $updatedField = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data): array
    {

        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

    private function hashPassword(string $plaintextPassword): string
    {
        return password_hash($plaintextPassword, PASSWORD_BCRYPT);
    }
    

    /// get user information
    public function getallJobData()
    {
        $builder = $this->db->table('job_listings');
        $builder->select('job_listings.*, hoteliers.*');
        $builder->join('hoteliers', 'hoteliers.user_id = job_listings.hotelier_id');
        
        $query = $builder->get();
    
        // Get the result
        $result = $query->getResult();
    
        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }
    public function getJobDataid($id)
    {
        $builder = $this->db->table('job_listings');
        $builder->select('job_listings.*, hoteliers.*');
        $builder->join('hoteliers', 'hoteliers.user_id = job_listings.hotelier_id');
        $builder->where('job_listings.id', $id);
        $query = $builder->get();
    
        // Get the result
        $result = $query->getResult();
    
        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }
    public function getJobData($userId)
    {
        $builder = $this->db->table('job_listings');
        $builder->select('job_listings.*, hoteliers.name,hoteliers.address,hoteliers.city,hoteliers.state,hoteliers.pin_code,hoteliers.address,');
        $builder->join('hoteliers', 'hoteliers.user_id = job_listings.hotelier_id');
        $builder->where('job_listings.hotelier_id', $userId);
        $query = $builder->get();
    
        // Get the result
        $result = $query->getResult();
    
        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }



    
    public function findJobById(string $id)
    {

        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user) {
            throw new Exception('Job does not found');
        } else {
            return $user;
        }
    }

    public function findAll(int $limit = 0, int $offset = 0)
    {
        if ($this->tempAllowCallbacks) {
            // Call the before event and check for a return
            $eventData = $this->trigger('beforeFind', [
                'method'    => 'findAll',
                'limit'     => $limit,
                'offset'    => $offset,
                'singleton' => false,
            ]);

            if (!empty($eventData['returnData'])) {
                return $eventData['data'];
            }
        }

        $eventData = [
            'data'      => $this->doFindAll($limit, $offset),
            'limit'     => $limit,
            'offset'    => $offset,
            'method'    => 'findAll',
            'singleton' => false,
        ];

        if ($this->tempAllowCallbacks) {
            $eventData = $this->trigger('afterFind', $eventData);
        }

        $this->tempReturnType     = $this->returnType;
        $this->tempUseSoftDeletes = $this->useSoftDeletes;
        $this->tempAllowCallbacks = $this->allowCallbacks;

        return $eventData['data'];
    }
   


    public function save($data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        $hotelier_id = $data['user_id'];
        // $Hotel_name = $data['Hotel_name'];
        $job_type = $data['job_type'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $job_title = $data['job_title'];
        $job_description = $data['job_description'];
        // $location = $data['location'];
        // $state = $data['state'];
        // $city = $data['city'];
        $department = $data['department'];
        $sub_department = $data['sub_department'];
        $education= $data['education'];
        $off_salery = $data['off_salery'];
        $experience = $data['experience'];
        $number_employees = $data['number_employees'];
        $status = '1';
    
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `job_listings`( `hotelier_id`,`job_type`, `start_time`, `end_time`, `job_title`, `job_description`, `department`, `sub_department`, `education`, `off_salery`, `experience`, `number_employees`, `created_at`, `updated_at`, `status`) VALUES ('$hotelier_id','$job_type','$start_time','$end_time','$job_title','$job_description','$department','$sub_department','$education','$off_salery','$experience','$number_employees','$date1','$date1','$status')";


        //     echo "<pre>"; print_r($sql); echo "</pre>";
        // die();

        $post = $this->db->query($sql);
        // echo json_encode($post);
        if (!$post){
            throw new Exception('Job does not save');
        }
           

        return $post;
    }

    public function update1($id, $data): bool
    {

        // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }

     
        // $Hotel_name = $data['Hotel_name'];
        $job_type = $data['job_type'];
        $start_time = $data['start_time'];
        $end_time = $data['end_time'];
        $job_title = $data['job_title'];
        $job_description = $data['job_description'];
        // $location = $data['location'];
        // $state = $data['state'];
        // $city = $data['city'];
        $department = $data['department'];
        $sub_department = $data['sub_department'];
        $education= $data['education'];
        $off_salery = $data['off_salery'];
        $experience = $data['experience'];
        $number_employees = $data['number_employees'];
        $status = '1';
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date('Y-m-d H:i:s');


        $sql = "UPDATE `job_listings` SET  
       
       job_type= '$job_type',
       
       start_time= '$start_time',
       end_time= '$end_time',
       job_title= '$job_title',
       job_description= '$job_description',
       
       department= '$department',
       sub_department= '$sub_department',
       education= '$education',
       off_salery= '$off_salery',
       experience= '$experience',
       number_employees= '$number_employees',

        updated_at = '$date1',
        status = '$status'
          WHERE id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }
    public function update_st($id, $data): bool
    {

        // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }

     
       
        $status = $data['status'];
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date('Y-m-d H:i:s');
        $sql = "UPDATE `job_listings` SET  updated_at = '$date1',status = '$status' WHERE id = $id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }
    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('user does not exist for specified id');

        return $post;
    }
}

