<?php

namespace App\Models;

use CodeIgniter\Model;

class EtsyModel extends Model
{
    public function getAllShopNames() {
        $db = \Config\Database::connect();
        $query = $this->db->query('SELECT shop_name FROM tbl_etsy WHERE deleted_flg = 0 AND active_flg = 1');
        $results = $query->getResult();
        return $results;
    }
}