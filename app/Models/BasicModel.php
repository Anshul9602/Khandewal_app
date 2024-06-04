<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use \Datetime;



class BasicModel extends Model
{
    protected $table = 'basic_table';
    protected $userProfileTable = 'user_profiles';
    // protected $allowedFields = [
    //     'name',
    //     'email',
    //     'retainer_fee'
    // ];
    protected $db;
    protected $updatedField = 'updated_at';





    public function getEmptyFields($user_id)
    {

        $data['user_pro'] = $this->getUserProfileEmptyFields($user_id);
        $data['user_edu'] = $this->getUserEduEmptyFields($user_id);
        $data['user_work'] = $this->getUserWorkEmptyFields($user_id);
        $data['user_Job_pref'] = $this->getUserJobEmptyFields($user_id);
        $data['user_resume'] = $this->getUserResEmptyFields($user_id);
        $data['user_img'] = $this->getUserImgEmptyFields($user_id);
        $data['users'] = 0;

        // print_r($data);

        return $data;

        // Debugging: Print the result of the query

    }
    public function getHEmptyFields($user_id)
    {

        $data['user_pro'] = $this->getHProfileEmptyFields($user_id);
        
        $data['user_img'] = $this->getUserImgEmptyFields($user_id);
        $data['users'] = 0;

        // print_r($data);

        return $data;

        // Debugging: Print the result of the query

    }
    public function getHProfileEmptyFields($user_id)
    {
        $builder = $this->db->table('hoteliers');
        $builder->select('*'); // Use '*' to select all columns
        $builder->where('hoteliers.user_id', $user_id);
        $userData = $builder->get()->getRow();

        // Debugging: Print the fetched user data
        // print_r($userData);
        if ($userData) {
            $query = $this->db->table('hoteliers')
                ->select([
                    'user_id',
                    'SUM(CASE WHEN name IS NULL OR name = "" THEN 1 ELSE 0 END) AS name_empty',
                    'SUM(CASE WHEN location IS NULL OR location = "" THEN 1 ELSE 0 END) AS location_empty',
                    'SUM(CASE WHEN email IS NULL OR email = "" THEN 1 ELSE 0 END) AS email_empty',
                    'SUM(CASE WHEN address IS NULL OR address = "" THEN 1 ELSE 0 END) AS address_empty',
                    'SUM(CASE WHEN state IS NULL OR state = "" THEN 1 ELSE 0 END) AS state_empty',
                    'SUM(CASE WHEN pin_code IS NULL THEN 1 ELSE 0 END) AS pin_code_empty',
                    'SUM(CASE WHEN city IS NULL OR city = "" THEN 1 ELSE 0 END) AS city_empty',
                    'SUM(CASE WHEN role IS NULL OR role = "" THEN 1 ELSE 0 END) AS role_empty',                 
                    'SUM(CASE WHEN country IS NULL OR country = "" THEN 1 ELSE 0 END) AS country_empty',
                    'SUM(CASE WHEN gst_number IS NULL OR gst_number = "" THEN 1 ELSE 0 END) AS gst_number_empty',
                    'SUM(CASE WHEN gst_name IS NULL OR gst_name = "" THEN 1 ELSE 0 END) AS gst_name_empty',
                    'SUM(CASE WHEN reg_email IS NULL OR reg_email = "" THEN 1 ELSE 0 END) AS reg_email_empty',
                    'SUM(CASE WHEN reg_hadd IS NULL OR reg_hadd = "" THEN 1 ELSE 0 END) AS reg_hadd_empty',
               
                ])
                ->where('user_id', $user_id)
                ->get();

            $result = $query->getRow();

            // Debugging: Print the result of the query
            // print_r($result);
            foreach ($result as $property => $value) {
                if ($value == 1) {
                    return 1;
                }
            }
            return 0;
        } else {
            return 1;
        }
        // Run the query to count empty fields

    }
    public function getUserProfileEmptyFields($user_id)
    {
        $builder = $this->db->table('user_profiles');
        $builder->select('*'); // Use '*' to select all columns
        $builder->where('user_profiles.user_id', $user_id);
        $userData = $builder->get()->getRow();

        // Debugging: Print the fetched user data
        // print_r($userData);
        if ($userData) {
            $query = $this->db->table('user_profiles')
                ->select([
                    'user_id',
                    'SUM(CASE WHEN name IS NULL OR name = "" THEN 1 ELSE 0 END) AS name_empty',
                    'SUM(CASE WHEN last_name IS NULL OR last_name = "" THEN 1 ELSE 0 END) AS last_name_empty',
                    'SUM(CASE WHEN gender IS NULL OR gender = "" THEN 1 ELSE 0 END) AS gender_empty',
                    'SUM(CASE WHEN email IS NULL OR email = "" THEN 1 ELSE 0 END) AS email_empty',
                    'SUM(CASE WHEN role IS NULL OR role = "" THEN 1 ELSE 0 END) AS role_empty',
                    'SUM(CASE WHEN address IS NULL OR address = "" THEN 1 ELSE 0 END) AS address_empty',
                    'SUM(CASE WHEN pin_code IS NULL THEN 1 ELSE 0 END) AS pin_code_empty',
                    'SUM(CASE WHEN dob IS NULL THEN 1 ELSE 0 END) AS dob_empty',
                    'SUM(CASE WHEN state IS NULL OR state = "" THEN 1 ELSE 0 END) AS state_empty',
                    'SUM(CASE WHEN city IS NULL OR city = "" THEN 1 ELSE 0 END) AS city_empty',
                    'SUM(CASE WHEN country IS NULL OR country = "" THEN 1 ELSE 0 END) AS country_empty'
                ])
                ->where('user_id', $user_id)
                ->get();

            $result = $query->getRow();

            // Debugging: Print the result of the query
            // print_r($result);
            foreach ($result as $property => $value) {
                if ($value == 1) {
                    return 1;
                }
            }
            return 0;
        } else {
            return 1;
        }
        // Run the query to count empty fields

    }
    public function getUserEduEmptyFields($user_id)
    {
        $builder = $this->db->table('user_education');
        $builder->select('*'); // Use '*' to select all columns
        $builder->where('user_education.user_id', $user_id);
        $userData = $builder->get()->getRow();
        //  print_r($userData);
        if ($userData) {
            // $query = $this->db->table('user_education')
            //     ->select([
            //         'id', // Include the 'id' field
            //         'SUM(CASE WHEN ten_th IS NULL OR ten_th = "" THEN 1 ELSE 0 END) AS ten_th_empty',
            //         'SUM(CASE WHEN ten_school IS NULL OR ten_school = "" THEN 1 ELSE 0 END) AS ten_school_empty',
            //         'SUM(CASE WHEN ten_year IS NULL OR ten_year = "" THEN 1 ELSE 0 END) AS ten_year_empty',
            //         'SUM(CASE WHEN to_th IS NULL OR to_th = "" THEN 1 ELSE 0 END) AS to_th_empty',
            //         'SUM(CASE WHEN to_th_school IS NULL OR to_th_school = "" THEN 1 ELSE 0 END) AS to_th_school_empty',
            //         'SUM(CASE WHEN to_th_year IS NULL OR to_th_year = "" THEN 1 ELSE 0 END) AS to_th_year_empty',
            //         'SUM(CASE WHEN gra_dip IS NULL OR gra_dip = "" THEN 1 ELSE 0 END) AS gra_dip_empty',
            //         'SUM(CASE WHEN gr_degree IS NULL OR gr_degree = "" THEN 1 ELSE 0 END) AS gr_degree_empty',
            //         'SUM(CASE WHEN gr_university IS NULL OR gr_university = "" THEN 1 ELSE 0 END) AS gr_university_empty',
            //         'SUM(CASE WHEN gr_year IS NULL OR gr_year = "" THEN 1 ELSE 0 END) AS gr_year_empty',
            //         'SUM(CASE WHEN post_gra IS NULL OR post_gra = "" THEN 1 ELSE 0 END) AS post_gra_empty',
            //         'SUM(CASE WHEN pg_degree IS NULL OR pg_degree = "" THEN 1 ELSE 0 END) AS pg_degree_empty',
            //         'SUM(CASE WHEN pg_university IS NULL OR pg_university = "" THEN 1 ELSE 0 END) AS pg_university_empty',
            //         'SUM(CASE WHEN pg_year IS NULL OR pg_year = "" THEN 1 ELSE 0 END) AS pg_year_empty',
            //         'SUM(CASE WHEN doc IS NULL OR doc = "" THEN 1 ELSE 0 END) AS doc_empty',
            //         'SUM(CASE WHEN doc_degree IS NULL OR doc_degree = "" THEN 1 ELSE 0 END) AS doc_degree_empty',
            //         'SUM(CASE WHEN doc_university IS NULL OR doc_university = "" THEN 1 ELSE 0 END) AS doc_university_empty',
            //         'SUM(CASE WHEN doc_year IS NULL OR doc_year = "" THEN 1 ELSE 0 END) AS doc_year_empty',
            //         'SUM(CASE WHEN hotel_de IS NULL OR hotel_de = "" THEN 1 ELSE 0 END) AS hotel_de_empty',
            //         'SUM(CASE WHEN h_college IS NULL OR h_college = "" THEN 1 ELSE 0 END) AS h_college_empty',
            //         'SUM(CASE WHEN h_year IS NULL OR h_year = "" THEN 1 ELSE 0 END) AS h_year_empty',
            //         'SUM(CASE WHEN created_at IS NULL OR created_at = "" THEN 1 ELSE 0 END) AS created_at_empty'
            //     ])
            //     ->where('user_id', $user_id)
            //     ->get();

            // $result = $query->getRow();

            // // Debugging: Print the result of the query
            // // print_r($result);
            // foreach ($result as $property => $value) {
            //     if ($value == 1) {
            //         return 1;
            //     }
            // }
            return 0;
        } else {
            return 1;
        }
        // echo "test";

    }
    public function getUserWorkEmptyFields($user_id)
    {
        $builder = $this->db->table('working_experiences');
        $builder->select('*'); // Use '*' to select all columns
        $builder->where('working_experiences.user_id', $user_id);
        $userData = $builder->get()->getRow();
        //  print_r($userData);
        if ($userData) {
            $query = $this->db->table('working_experiences')
                ->select([
                    'id', // Include the 'id' field
                    'SUM(CASE WHEN organisation IS NULL OR organisation = "" THEN 1 ELSE 0 END) AS organisation_empty',
                    'SUM(CASE WHEN designation IS NULL OR designation = "" THEN 1 ELSE 0 END) AS designation_empty',
                    'SUM(CASE WHEN ref_mobile IS NULL OR ref_mobile = "" THEN 1 ELSE 0 END) AS ref_mobile_empty',
                    'SUM(CASE WHEN ref_email IS NULL OR ref_email = "" THEN 1 ELSE 0 END) AS ref_email_empty',
                    'SUM(CASE WHEN profile IS NULL OR profile = "" THEN 1 ELSE 0 END) AS profile_empty',
                    'SUM(CASE WHEN location IS NULL OR location = "" THEN 1 ELSE 0 END) AS location_empty',
                    'SUM(CASE WHEN start_date IS NULL OR start_date = "" THEN 1 ELSE 0 END) AS start_date_empty',
                    'SUM(CASE WHEN end_date IS NULL OR end_date = "" THEN 1 ELSE 0 END) AS end_date_empty',
                    'SUM(CASE WHEN created_at IS NULL OR created_at = "" THEN 1 ELSE 0 END) AS created_at_empty',
                    'SUM(CASE WHEN updated_at IS NULL OR updated_at = "" THEN 1 ELSE 0 END) AS updated_at_empty'
                ])
                ->where('user_id', $user_id)
                ->get();

            $result = $query->getRow();

            // Debugging: Print the result of the query
            // print_r($result);
            foreach ($result as $property => $value) {
                if ($value == 1) {
                    return 1;
                }
            }
            return 0;
        } else {
            return 1;
        }
        // echo "test";

    }
    public function getUserJobEmptyFields($user_id)
    {
        $builder = $this->db->table('job_pref_user');
        $builder->select('*');
        $builder->where('job_pref_user.user_id', $user_id);
        $userData = $builder->get()->getRow();

        if (!$userData) {
            return 1; // No user data found
        }

        $query = $this->db->table('job_pref_user')
            ->select([
                'id',
                'SUM(CASE WHEN job_type IS NULL OR job_type = "" THEN 1 ELSE 0 END) AS job_type_empty',
                'SUM(CASE WHEN department IS NULL OR department = "" THEN 1 ELSE 0 END) AS department_empty',
                'SUM(CASE WHEN sub_dep IS NULL OR sub_dep = "" THEN 1 ELSE 0 END) AS sub_dep_empty',
                'SUM(CASE WHEN pref_state IS NULL OR pref_state = "" THEN 1 ELSE 0 END) AS pref_state_empty',
                'SUM(CASE WHEN pref_city IS NULL OR pref_city = "" THEN 1 ELSE 0 END) AS pref_city_empty',
                'SUM(CASE WHEN salery IS NULL THEN 1 ELSE 0 END) AS salery_empty',
                'SUM(CASE WHEN created_at IS NULL OR created_at = "" THEN 1 ELSE 0 END) AS created_at_empty',
                'SUM(CASE WHEN updated_at IS NULL OR updated_at = "" THEN 1 ELSE 0 END) AS updated_at_empty',
                'SUM(CASE WHEN job_type = "Full Time" THEN 0 ELSE (CASE WHEN start_time IS NULL OR start_time = "" THEN 1 ELSE 0 END) END) AS start_time_empty',
                'SUM(CASE WHEN job_type = "Full Time" THEN 0 ELSE (CASE WHEN end_time IS NULL OR end_time = "" THEN 1 ELSE 0 END) END) AS end_time_empty'
            ])
            ->where('user_id', $user_id)
            ->get();

        $result = $query->getRow();

        foreach ($result as $property => $value) {
            if ($value == 1) {
                return 1; // At least one empty field found
            }
        }

        return 0; // No empty fields found
    }
    public function getUserResEmptyFields($user_id)
    {
        $builder = $this->db->table('resumes');
        $builder->select('*'); // Use '*' to select all columns
        $builder->where('resumes.user_id', $user_id);
        $userData = $builder->get()->getRow();
        //  print_r($userData);
        if ($userData) {
            $query = $this->db->table('resumes')
                ->select([
                    'id', // Include the 'id' field
                    'SUM(CASE WHEN Resume IS NULL OR Resume = "" THEN 1 ELSE 0 END) AS Resume_empty',
                    'SUM(CASE WHEN created_at IS NULL OR created_at = "" THEN 1 ELSE 0 END) AS created_at_empty'
                ])
                ->where('user_id', $user_id)
                ->get();

            $result = $query->getRow();

            // Debugging: Print the result of the query
            // print_r($result);
            foreach ($result as $property => $value) {
                if ($value == 1) {
                    return 1;
                }
            }
            return 0;
        } else {
            return 1;
        }
        // echo "test";

    }
    public function getUserImgEmptyFields($user_id)
    {
        $builder = $this->db->table('user_profile_images');
        $builder->select('*'); // Use '*' to select all columns
        $builder->where('user_profile_images.user_id', $user_id);
        $userData = $builder->get()->getRow();
        //  print_r($userData);
        if ($userData) {
            $query = $this->db->table('user_profile_images')
                ->select([
                    'id', // Include the 'id' field
                    'SUM(CASE WHEN image_path IS NULL OR image_path = "" THEN 1 ELSE 0 END) AS image_path_empty',
                    'SUM(CASE WHEN created_at IS NULL OR created_at = "" THEN 1 ELSE 0 END) AS created_at_empty',
                    'SUM(CASE WHEN updated_at IS NULL OR updated_at = "" THEN 1 ELSE 0 END) AS updated_at_empty'
                ])
                ->where('user_id', $user_id)
                ->get();

            $result = $query->getRow();

            // Debugging: Print the result of the query
            // print_r($result);
            foreach ($result as $property => $value) {
                if ($value == 1) {
                    return 1;
                }
            }
            return 0;
        } else {
            return 1;
        }
        // echo "test";

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
    public function all_state()
    {
        $builder = $this->db->table('all_states');
        $builder->select('*'); // Use '*' to select all columns

        $query = $builder->get();

        return $query->getResult();
    }
    public function city_state_state($Id)
    {
        $builder = $this->db->table('all_cities');
        $builder->select(' all_cities.*');
        $builder->where('all_cities.state_code', $Id);
        $query = $builder->get();

        return $query->getResult();
    }
    public function all_state1()
    {
        $builder = $this->db->table('unified_pincodes');
        $builder->select('*');

        $query = $builder->get();

        return $query->getResult();
    }
    public function save($data): bool
    {

        $whatsapp = $data['whatsapp'];
        $mobile = $data['mobile'];
        $email = $data['email'];
        $hiw = $data['hiw'];
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');

        $date1 = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `basic_table`( `whatsapp`,`mobile`, `email`, `created_at`,`updated_at`) VALUES ('$whatsapp','$mobile','$email','$date1','$date1')";

        $post = $this->db->query($sql);
        // echo json_encode($post);
        if (!$post)
            throw new Exception('Post does not exist for specified id');

        return $post;
    }

    public function update_num($data): bool
    {

        if (empty($data)) {
            echo "1";
            return true;
        }

        $whatsapp = $data['whatsapp'];
        $mobile = $data['mobile'];
        $email = $data['email'];
        $hiw = $data['hiw'];
        $date = new DateTime();
        $date = date_default_timezone_set('Asia/Kolkata');
        $date1 = date('Y-m-d H:i:s');

        $sql = "UPDATE `basic_table` SET  
        whatsapp= '$whatsapp',
        email= '$email',
        mobile= '$mobile',
        hiw= '$hiw',
        updated_at= '$date1'
              
         WHERE id = 1";
        // echo "<pre>"; print_r($sql);
        // echo "</pre>";
        $post = $this->db->query($sql);
        if (!$post)
            throw new Exception('basic detals does not exist for specified id');

        return $post;
    }

    public function delete_us($id)
    {
        // Prepare the SQL statement with a placeholder for the id
        $sql = "DELETE FROM `basic_table` WHERE id = ?";

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
