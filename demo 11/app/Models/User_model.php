<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    public function login($username, $password)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $query = $builder->get();
        $user = $query->getRow(); // fetch row data as object
        if ($user) {
            if (password_verify($password, $user->password)) {
                return true;
            }
            return false;
        }
        return false;
    }

    
    public function Signup($username, $password, $email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('email', $email);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return false;
        } else {
            return true;
        }
    }
    
    public function Signupfirst($username,$password,$email, $token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $data = [
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'resetToken' => $token
        ];
        $db->table('users')->insert($data);
        return true;

    }

    public function Confirmation($username, $token){
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('resetToken', $token);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        } 
        else {
            $builder->where('username', $username);
            $builder->delete();
            return false;
        }
    }
    public function getUser($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $query = $builder->get();
        return $query->getRow();
    }

    public function updateUser($username, $data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username)->update($data);
    }

    
    public function update_image($username, $image_path) {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username',$username)->update(['image'=>$image_path]);
    }
}

