<?php

namespace App\Models;

use CodeIgniter\Model;

class PaypalModel extends MyBaseModel
{
    public function getAll() {
        $arrEmails = $this->getAllPaypalEmail();

        if (empty($arrEmails)) {
            $errors[] = 'There is no PayPal account';
            $session = session();
            $session->setFlashdata('errors', $errors);
            return FALSE;
        }

        $db = \Config\Database::connect();

        $results = [];

        foreach ($arrEmails as $row) {
            //get blance
            $sql = 'SELECT pp.email, pp.active_flg as active_flg, pp.type, pp.remark, IFNULL(ppt.balance,0) as balance FROM tbl_paypal pp 
                LEFT JOIN tbl_paypal_transaction ppt ON pp.email = ppt.paypal_email
                WHERE pp.email = "' . $row->email . '"
                ORDER BY id DESC LIMIT 1
            ';
            //$query = $this->db->query('SELECT * FROM tbl_paypal ORDER BY active_flg DESC');
            $query = $this->db->query($sql);
            $rs = $query->getResult();
            // $this->print($rs);

            $tranWithBalance = new \stdClass;
            if (!empty($rs)) {
                $tranWithBalance = $rs[0];
            }

            //get holding
            // $tranWithBalance->amounts = $this->getHoldAndReleaseAmount($row->email);
            $amounts = $this->getHoldAndReleaseAmount($row->email);
            // $this->print($amounts);
            $tranWithBalance = (object) array_merge(
                (array) $amounts, (array) $tranWithBalance
            );
            $results[] = $tranWithBalance;
        }
        return $results;
    }
    
    public function getAllPaypalEmail() {
        $db = \Config\Database::connect();
        $query = $this->db->query('SELECT email FROM tbl_paypal WHERE deleted_flg = 0 ORDER BY active_flg DESC');
        $results = $query->getResult();
        return $results;
    }

    public function getHoldAndReleaseAmount($email) {
        $db = \Config\Database::connect();
            $sql = 'SELECT `paypal_email`, `type`, SUM(`net`) as sum_net
                FROM `tbl_paypal_transaction` 
                GROUP BY `type`, `paypal_email`
                HAVING paypal_email = "' . $email . '"
            ';
        $query = $this->db->query($sql);
        $results = $query->getResult();
        // $this->print($results);
        $data = new \stdClass;
        $data->paypal_email = $email;
        $hold_amount = 0;
        $release_amount = 0;

        if (!empty($results)) {
            foreach ($results as $row) {
                if ($row->type == 'Payment Hold') {
                    $hold_amount = $row->sum_net;
                    //$data->hold_amount = $row->sum_net;
                }
                if ($row->type == 'Payment Release') {
                    $release_amount = $row->sum_net;
                    //$data->release_amount = $row->sum_net;
                }
            }
            
        }
        $data->hold_amount = round($hold_amount, 2);
        $data->release_amount = round($release_amount, 2);
        $data->holding_amount = round($hold_amount + $release_amount, 2);
        return $data;
    }
}