<?php namespace App\Models;

use CodeIgniter\Model;

class Data_model extends Model
{
    public function get_data($page)
    {
        // Calculate the start and limit for the current page
        $start = ($page - 1) * 10;
        $limit = 10;

        // Fetch the data from the database
        
        $builder = $this->db->table('data');
        $builder->select('*');
        $builder->orderBy('id', 'ASC');
        $builder->limit($limit, $start);
        $query = $builder->get();

        // Return the data as an array
        return $query->getResultArray();
    }
}
