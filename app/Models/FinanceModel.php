<?php

namespace App\Models;

use CodeIgniter\Model;

class FinanceModel extends MyBaseModel
{
    public function getAll($conditions) {
        $sqlWhere = '';
        if (!empty($conditions)) {
            foreach ($conditions as $cond) {
                $sqlWhere .= ' AND ' . $cond;
            }
        }
        $db = \Config\Database::connect();
        $sql = 'SELECT * FROM tbl_finance WHERE deleted_flg = 0 ' . $sqlWhere . ' ORDER BY id DESC LIMIT 50';
        // echo $sql; exit;
        $query = $this->db->query($sql);
        $results = $query->getResult();
        return $results;
    }

    public function getCurrentBalance($account) {
        
        $db = \Config\Database::connect();
        $sql = 'SELECT balance FROM tbl_finance WHERE deleted_flg = 0 AND account = "' . $account . '" ORDER BY id DESC LIMIT 1';
        // echo $sql; exit;
        $query = $this->db->query($sql);
        $results = $query->getResult();
        return $results;
    }

    public function insertTransaction($data) {
        $db = \Config\Database::connect();
        $sql = $db->table('tbl_finance')->set($data)->getCompiledInsert();
        // $this->print($sql);exit;
        $db->query($sql);
    }

    public function getAllBank() {
        $db = \Config\Database::connect();
        $sql = 'SELECT * FROM tbl_bank WHERE deleted_flg = 0 ';
        $query = $this->db->query($sql);
        $results = $query->getResult();
        return $results;
    }
}