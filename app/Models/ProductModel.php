<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends MyBaseModel
{
    public function getAll($conditions) {
        $sqlWhere = '';
        if (!empty($conditions)) {
            foreach ($conditions as $cond) {
                $sqlWhere .= ' AND ' . $cond;
            }
        }
        $db = \Config\Database::connect();
        $sql = 'SELECT * FROM tbl_product WHERE deleted_flg = 0 ' . $sqlWhere . ' ORDER BY id DESC LIMIT 20';
        // echo $sql; exit;
        $query = $this->db->query($sql);
        $results = $query->getResult();
        return $results;
    }

    public function insertProduct($data) {
        $db = \Config\Database::connect();
        $sql = $db->table('tbl_product')->set($data)->getCompiledInsert();
        // $this->print($sql);exit;
        $db->query($sql);
    }

    public function updateProduct($id, $data) {
        $db = \Config\Database::connect();
        // $sql = $db->table('tbl_product')->set($data)->getCompiledUpdate();
        $builder = $db->table('tbl_product');
        $builder->where('id', $id);
        $builder->update($data);
    }

}