<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    public function getAll() {
        $db = \Config\Database::connect();
        $query = $this->db->query('SELECT * FROM tbl_email');
        $results = $query->getResult();
        return $results;
    }
}