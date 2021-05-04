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

    public function getSummary() {
        
        $db = \Config\Database::connect();
        // $sql = 'SELECT account, IFNULL(f.balance,0) AS blance, f.deleted_flg, b.deleted_flg, MAX(f.id) max_id, f.id
        //     FROM  b 
        //         LEFT JOIN tbl_finance f
        //         ON b.name = f.account
        //     GROUP BY f.account
        //     HAVING f.deleted_flg = 0 AND b.deleted_flg = 0 
        //     ORDER BY f.id ASC
        // ';

        $sql = 'SELECT B.account_number, IFNULL(Tbl.balance,0) AS balance, B.name as account
            FROM tbl_bank B
            LEFT JOIN
            (
            SELECT  account, balance, F.id as id
            FROM tbl_finance F
            JOIN (
                SELECT id, max(id) max_id
                FROM tbl_finance 
                GROUP BY account) T
                 ON F.id = T.max_id) Tbl
            ON B.name = Tbl.account     
        ';
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