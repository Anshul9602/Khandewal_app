<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;


// structure

//save
//find by id--
//find all
// deletes by id
// activity
//update service    
class BannerModel extends Model
{
    protected $table = 'banner';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';
// --- banner ---//
  

   
    public function findBannerById($id)
    {
        $post = $this
            ->asArray()
            ->where(['bn_id' => $id])
            ->first();

        if (!$post) 
            throw new Exception('banner does not exist for specified id');

        return $post;
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

            if (! empty($eventData['returnData'])) {
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
    public function deletedata($id)
    {
        $post = $this
            ->asArray()
            ->where(['bn_id' => $id])
            ->delete();

        if (!$post) 
            throw new Exception('banner does not exist for specified id');

        return $post;
    }
    
   
   
    public function update1($id ,$data): bool
    {
        if (empty($data)) {
            echo "1";
            return true;
        }
        $image = $data['image'];
        
        $sql = "UPDATE `banner` SET  
        image= '$image'
         WHERE bn_id = $id";
        $post = $this->db->query($sql);
        if (!$post) 
        throw new Exception('banner does not exist for specified id');

         return $post;  
    }
    
   
    public function curPostRequest()
    {
        /* Endpoint */
        $url = 'https://fcm.googleapis.com/fcm/send';
   
        /* eCurl */
        $curl = curl_init($url);
   
        /* Data */
        $data = [
            'name'=>'John Doe', 
            'email'=>'johndoe@yahoo.com'
        ];
   
        /* Set JSON data to POST */
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            
        /* Define content type */
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'App-Key: JJEK8L4',
            'App-Secret: 2zqAzq6'
        ));
            
        /* Return json */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
        /* make request */
        $result = curl_exec($curl);
             
        /* close curl */
        curl_close($curl);
    }


}