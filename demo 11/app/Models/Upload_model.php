<?php

namespace App\Models;

use CodeIgniter\Model;

class Upload_model extends Model
{
    public function upload($username, $title, $filenames, $comment)
    {
        $db = \Config\Database::connect();
        // Join the filenames array into a string with a comma separator
        $filenameString = implode(',', $filenames);

        $data = [
            'username' => $username,
            'title' => $title,
            'filename' => $filenameString,
            'comment' => $comment
        ];
        return $db-> table('Uploads')->insert($data);
    }
    
}

