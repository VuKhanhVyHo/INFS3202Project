<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    public function checkUser($username, $email){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('email',$email);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        }
        return false; 
    }
    public function setToken($username, $token) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username',$username)->update(['resetToken'=>$token]);
    }
    public function getToken ($username, $token) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('resetToken',$token);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        }
        return false; 
    }
    public function resetPassword($username, $password){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username)->update(['password'=>$password]);
    }
}

