<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class UserModel extends Model
{
    protected $table = 'users';

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
    public function getUserData($userId)
    {

        $builder = $this->db->table('user_profiles');
        $builder->select('user_profiles.*');

        $builder->where('user_profiles.user_id', $userId);
        $query = $builder->get();

        $user = $query->getResult();


        if (!$user) {
            return null;
        } else {
            return $user[0];
        }
    }

    public function getAllUserData()
    {
        $builder = $this->db->table('users');
        $builder->select('users.*, user_profiles.*');
        $builder->join('user_profiles', 'user_profiles.user_id = users.id');
        $query = $builder->get();
        $user = $query->getResult();
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        // die();
        if (empty($user)) {
            // echo "test";
            return false;
        } else {
            return $user;
        }
    }
    public function getUserCount()
    {
        $builder = $this->db->table('users');
        $builder->select('COUNT(*) as user_count');

        $query = $builder->get();
        $result = $query->getRow();

        return $result->user_count;
    }
  



    public function findUserByUserNumber1(string $mobile_number)
    {
        // echo "test";
        // die();
        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return 0;
        } else {
            return 1;
        }
    }

    public function findUserByUserNumber(string $mobile_number)
    {

        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return null;
        } else {
            return $user;
        }
    }
    public function findUserByUserName(string $mobile_number)
    {

        $user = $this
            ->asArray()
            ->where(['mobile_number' => $mobile_number])
            ->first();

        if (!$user) {
            return null;
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
    public function findUserById($id)
    {
        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user)
            throw new Exception('User does not exist for specified user id');

        return $user;
    }


    public function save($data): bool
    {

        $mobile_number = $data;
        // echo "<pre>"; print_r($mobile_number); echo "</pre>";
        // die();
        $status = "Enable";
        $work_ex = "fresher";
        $points = '0';
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `users`(`mobile_number`, `created_at`, `updated_at`, `last_active`, `points`,`work_ex`, `status`) VALUES ('$mobile_number','$date1','$date1','$date1','$points','$work_ex','$status')";


        //     echo "<pre>"; print_r($sql); echo "</pre>";
        // die();

        $post = $this->db->query($sql);
        // echo json_encode($post);
        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }

    public function save_profile($data)
    {

        $user_id = $data['user_id'];
        $name = $data['name'];
        $address = $data['address'];
       
        $state = $data['state'];
        $city = $data['city'];
     
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");


        $sql = "INSERT INTO `user_profiles`( `user_id`, `name`,`address`, `state`, `city`, `created_at`, `updated_at`) VALUES ('$user_id','$name','$address','$state','$city','$date1','$date1')";


        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }
    public function update_profile($id, $data)
    {
        //    echo json_encode($sql);
        $user_id = $id;
        $name = $data['name'];
        $address = $data['address'];
        $state = $data['state'];
        $city = $data['city'];
        $created_at = $data['created_at'];
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `user_profiles` SET   `address` = '$address',
       
        `name`='$name',`state`='$state',`city`='$city',`created_at`='$created_at',`updated_at`='$date1' WHERE user_id = $user_id";
        // echo json_encode($sql);
        // echo ( $sql);
        //     die();
        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }
    public function update_status_e($id)
    {
        //    echo json_encode($sql);
        $user_id = $id;

        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `users` SET `status`='Enable',`updated_at`='$date1' WHERE id = $user_id";
        // echo json_encode($sql);
        // echo ( $sql);
        //     die();
        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }
    public function update_status_d($id)
    {
        //    echo json_encode($sql);
        $user_id = $id;

        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date("m-d-Y h:i A");

        $sql = "UPDATE `users` SET `status`='Disable',`updated_at`='$date1' WHERE id = $user_id";
        // echo json_encode($sql);
        // echo ( $sql);
        //     die();
        $post = $this->db->query($sql);

        if (!$post) {
            return false;
        } else {
            return $post;
        }
    }

    public function delete_usweb($id)
    {
        // Prepare the SQL statement with a placeholder for the id
        $sql = "DELETE FROM `users` WHERE id = ?";

        // Execute the prepared statement with the id parameter
        $post = $this->db->query($sql, [$id]);

        // Check if the query was executed successfully
        if (!$post) {
            // If the query fails, return false
            return false;
        } else {
            // If the query succeeds, return true
            return true;
        }
    }
}