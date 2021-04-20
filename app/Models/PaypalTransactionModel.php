<?php

namespace App\Models;

use CodeIgniter\Model;

class PaypalTransactionModel extends MyBaseModel
{
    public function getAll($conditions) {
        // print_r($conditions);
        $sqlConditions = '';
        if (count($conditions) > 0) {
            $sqlConditions = 'AND ' . implode(" AND ", $conditions);
        }

		$sql = "SELECT * FROM tbl_paypal_transaction" 
			. " WHERE deleted_flg = 0 {$sqlConditions} ORDER BY id DESC ";

		// echo $sql;exit;

        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
			
        $results = $query->getResult();

	    return $results;
    }

    public function importCSV($csvData, $paypalEmail) {
        if (count($csvData) > 0 && $paypalEmail) {
			$index = 0;
			$ppTransactions = [];
			
			foreach ($csvData as $data) {

				if ($index > 0) {
					$i = 0;
					$ppTransactions[] = array(
						'date' => $data[$i++],
						'time' => $data[$i++],
						'timezone' => $data[$i++],
						'name' => $data[$i++],
						'type' => $data[$i++],
						'status' => $data[$i++],
						'currency' => $data[$i++],
						'gross' => $data[$i++],
						'fee' => $data[$i++],
						'net' => $data[$i++],
						'from_email_address' => $data[$i++],
						'to_email_address' => $data[$i++],
						'transaction_id' => $data[$i++],
						'shipping_address' => $data[$i++],
						'address_status' => $data[$i++],
						'item_title' => $data[$i++],
						'item_id' => $data[$i++],
						'shipping_and_handling_amount' => $data[$i++],
						'insurance_amount' => $data[$i++],
						'sales_tax' => $data[$i++],
						'option_1_name' => $data[$i++],
						'option_1_value' => $data[$i++],
						'option_2_name' => $data[$i++],
						'option_2_value' => $data[$i++],
						'reference_txn_id' => $data[$i++],
						'invoice_number' => $data[$i++],
						'custom_number' => $data[$i++],
						'quantity' => $data[$i++],
						'receipt_id' => $data[$i++],
						'balance' => $data[$i++],
						'address_line_1' => $data[$i++],
						'address_line_2' => $data[$i++],
						'city' => $data[$i++],
						'state' => $data[$i++],
						'postal_code' => $data[$i++],
						'country' => $data[$i++],
						'contact_phone_number' => $data[$i++],
						'subject' => $data[$i++],
						'note' => $data[$i++],
						'country_code' => $data[$i++],
						'balance_impact' => $data[$i++],
						'paypal_email' => $paypalEmail
					);
				}
				$index++;
			}

			if (count($ppTransactions) > 0) {
				// $this->myFunc->print($etsyOrders);
				$session = session();
				try {
					$db = \Config\Database::connect();
					foreach ($ppTransactions as $row) {
						$sql = $db->table('tbl_paypal_transaction')->set($row)->getCompiledInsert() . ' ON DUPLICATE KEY UPDATE duplicate=duplicate+1';
						// $this->myFunc->print($sql);
						$db->query($sql);
					}
					
					$session->setFlashdata("success", "Data saved successfully");
				} catch (Exception $e) {
					echo 'Caught exception: ',  $e->getMessage(), "\n";
					$session->setFlashdata("success", $e->getMessage());
				}
			}
		}
    }
}