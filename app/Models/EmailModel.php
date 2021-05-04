<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{
    public function getAll($email) {
        $db = \Config\Database::connect();
        $sql = 'SELECT * FROM tbl_email';

        if (!empty($email)) {
            $sql .= ' WHERE email LIKE "%' . $email . '%" OR main_paypal_email LIKE "%' . $email . '%"';
        }

        $query = $this->db->query($sql);
        $results = $query->getResult();
        return $results;
    }
}