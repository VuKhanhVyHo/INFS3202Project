<?php

namespace App\Models;

use CodeIgniter\Model;

class Search_model extends Model
{
    public function getSearch($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Cart');
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getResult();
    }


    public function Enrol($data) 
    {
        $db = \Config\Database::connect();
        $db -> table("Enrolling")->insert($data);
    }

    public function getCoursePrice($data)
    {
        $db = \Config\Database::connect();
        return $db -> table("courses")->where('courseCode', $data)->get() -> getRow();
    }

    public function addWish($data) 
    {
        $db = \Config\Database::connect();
        $db -> table("Cart")->insert($data);
    }

    public function removeCourse($courseCode, $username)
    {
        $db = \Config\Database::connect();
        $db -> table("Cart")->where('courseCode',$courseCode)->where('username', $username)->delete();
    }

    public function check($courseCode, $username) {
        $db = \Config\Database::connect();
        $builder = $db->table('Cart');
        $builder->where('username', $username);
        $builder->where('courseCode',$courseCode);
        $query = $builder->get();
        $user = $query->getRow(); // fetch row data as object
        if ($user) {
            return true;
        }
        return false;
    }
}
