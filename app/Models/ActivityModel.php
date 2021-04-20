<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    public function getAll() {
        $db = \Config\Database::connect();
        $query = $this->db->query('SELECT * FROM tbl_activity ORDER BY id DESC');
        $results = $query->getResult();
        return $results;
    }

    public function addActivity($data) {
        $db = \Config\Database::connect();
        $sql = $db->table('tbl_activity')->insert($data);
    }
}