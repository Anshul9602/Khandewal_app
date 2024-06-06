<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;

class ProfileModel extends Model
{
    protected $table = 'user_profile_images';

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
  
    public function findJobById(string $id)
    {

        $user = $this
            ->asArray()
            ->where(['id' => $id])
            ->first();

        if (!$user) {
            return null;
        } else {
            return $user;
        }
    }
    public function findByUId(string $id)
    {

        $user = $this
            ->asArray()
            ->where(['user_id' => $id])
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
   

 
    public function save($data): bool
    {

        $user_id = $data['user_id'];
        $image_path = $data['image_path'];
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `user_profile_images`( `user_id`, `image_path`, `created_at`,`updated_at`) VALUES ('$user_id','$image_path','$date1','$date1')";

        $post = $this->db->query($sql);
        // echo json_encode($post);
        if (!$post)
            throw new Exception('image does not exist for specified id');

        return $post;
    }

    public function update1($data): bool
    {

        // echo $id;

        if (empty($data)) {
            echo "1";
            return true;
        }
        $user_id = $data['user_id'];
        $image_path = $data['image_path'];
           
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date('Y-m-d H:i:s');


        $sql = "UPDATE `user_profile_images` SET  
        user_id = '$user_id',
        image_path = '$image_path',
      
        updated_at = '$date1'
          WHERE user_id = $user_id";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
        if (!$post)
            throw new Exception('image  does not update for specified id');

        return $post;
    }
    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['user_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('image does not exist for specified id');

        return $post;
    }
}

