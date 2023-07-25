<?php

namespace App\Models;

use CodeIgniter\Model;

class Search_model extends Model
{
    public function getSearch($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Enrolling');
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getResult();
    }


    public function Enrol($data) 
    {
        $db = \Config\Database::connect();
        $db -> table("Enrolling")->insert($data);
    }

    public function rate($courseCode, $username, $data){
        $db = \Config\Database::connect();
        $builder = $db->table('Enrolling');
        $builder->where('username', $username);
        $builder->where('courseCode', $courseCode);
        $builder->update($data);
    }
}
