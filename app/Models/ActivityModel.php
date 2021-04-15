<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    public function getAll() {
        $db = \Config\Database::connect();
        $query = $this->db->query('SELECT * FROM tbl_activity');
        $results = $query->getResult();
        return $results;
    }
}