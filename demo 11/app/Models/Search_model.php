<?php

namespace App\Models;

use CodeIgniter\Model;

class Search_model extends Model
{
    public function getSearchResults($search)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $builder->like('courseCode', $search);
        $builder->orLike('title', $search); // add this line to search the 'title' field
        $query = $builder->get();
        return $query->getResult();
    }

    public function Enrol($data) 
    {
        $db = \Config\Database::connect();
        $db -> table("Enrolling")->insert($data);
    }

    public function check($courseCode, $username) {
        $db = \Config\Database::connect();
        $builder = $db->table('Enrolling');
        $builder->where('username', $username);
        $builder->where('courseCode',$courseCode);
        $query = $builder->get();
        $user = $query->getRow(); // fetch row data as object
        if ($user) {
            return true;
        }
        return false;
    }

    public function getCourses($limit, $offset)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $builder->select('*');
        $builder->limit($limit, $offset);
        $query = $builder->get();
        return $query->getResult();
    }

}
