<?php

namespace App\Models;

use CodeIgniter\Model;

class EtsyOrderModel extends Model
{
    public function getAll($conditions) {
        // print_r($conditions);
        $sqlConditions = '';
        if (count($conditions) > 0) {
            $sqlConditions = 'AND ' . implode(" AND ", $conditions);
        }
        // echo "SELECT * FROM tbl_etsy_order WHERE deleted_flg = 0 AND canceled_flg = 0 {$sqlConditions} ORDER BY sale_date DESC";exit;
		$sql = "SELECT etsy.label, etsy_order.* FROM tbl_etsy_order etsy_order" 
			. ' INNER JOIN tbl_etsy etsy ON etsy_order.shop_name = etsy.shop_name'
			. " WHERE etsy_order.deleted_flg = 0 AND etsy_order.canceled_flg = 0 {$sqlConditions} ORDER BY sale_date DESC";
		// echo $sql;exit;
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
			
        $results = $query->getResult();

	    return $results;
    }

	// getAllNotFulfil
	public function getAllNotFulfil($conditions) {
        // print_r($conditions);
        $sqlConditions = '';
        if (count($conditions) > 0) {
            $sqlConditions = 'AND ' . implode(" AND ", $conditions);
        }
        // echo "SELECT * FROM tbl_etsy_order WHERE deleted_flg = 0 AND canceled_flg = 0 {$sqlConditions} ORDER BY sale_date DESC";exit;
		$sql = "SELECT * FROM tbl_etsy_order" 
			. " WHERE deleted_flg = 0 AND canceled_flg = 0 AND fulfilled_flg = 0 {$sqlConditions} ORDER BY sale_date DESC";
		// echo $sql;exit;
        $db = \Config\Database::connect();
        $query = $this->db->query($sql);
			
        $results = $query->getResult();

	    return $results;
    }

    public function updateFulfilledFlg($order_ids) {
        if (count($order_ids) > 0) {
            $db = \Config\Database::connect();
            $db->table('tbl_etsy_order')->whereIn('order_id', $order_ids)
                 ->set(['fulfilled_flg' => 1])
                 ->update();
        }
    }

	public function updateTrackingFlg($order_ids) {
        if (count($order_ids) > 0) {
            $db = \Config\Database::connect();
            $db->table('tbl_etsy_order')->whereIn('order_id', $order_ids)
                 ->set(['tracking_flg' => 1])
                 ->update();
        }
    }

    public function updateShippedFlg($order_ids) {
        if (count($order_ids) > 0) {
            $db = \Config\Database::connect();
            $db->table('tbl_etsy_order')->whereIn('order_id', $order_ids)
                 ->set(['shipped_flg' => 1])
                 ->update();
        }
    }

    public function importCSV($csvData, $shopName) {
        if (count($csvData) > 0 && $shopName) {
			$index = 0;
			$etsyOrders = [];
			
			foreach ($csvData as $data) {

				if ($index > 0) {
					$i = 0;
					$etsyOrders[] = array(
						"sale_date" => $data[$i++],
						"item_name" => $data[$i++],
						"buyer" => $data[$i++],
						"quantity" => $data[$i++],
						"price" => $data[$i++],
						"coupon_code" => $data[$i++],
						"coupon_details" => $data[$i++],
						"discount_amount" => $data[$i++],
						"shipping_discount" => $data[$i++],
						"order_shipping" => $data[$i++],
						"order_sales_tax" => $data[$i++],
						"item_total" => $data[$i++],
						"currency" => $data[$i++],
						"transaction_id" => $data[$i++],
						"listing_id" => $data[$i++],
						"date_paid" => $data[$i++],
						"date_shipped" => $data[$i++],
						"ship_name" => $data[$i++],
						"ship_address1" => $data[$i++],
						"ship_address2" => $data[$i++],
						"ship_city" => $data[$i++],
						"ship_state" => $data[$i++],
						"ship_zipcode" => $data[$i++],
						"ship_country" => $data[$i++],
						"order_id" => $data[$i++],
						"variations" => $data[$i++],
						"order_type" => $data[$i++],
						"listings_type" => $data[$i++],
						"payment_type" => $data[$i++],
						"inperson_discount" => $data[$i++],
						"inperson_location" => $data[$i++],
						"vat_paid_by_buyer" => $data[$i++],
						"sku" => $data[$i++],
						"shop_name" => $shopName
					);
				}
				$index++;
			}

			if (count($etsyOrders) > 0) {
				// $this->myFunc->print($etsyOrders);
				$session = session();
				try {
					$db = \Config\Database::connect();
					foreach ($etsyOrders as $row) {
						$sql = $db->table('tbl_etsy_order')->set($row)->getCompiledInsert() . ' ON DUPLICATE KEY UPDATE duplicate=duplicate+1';
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

	public function updateEtsyOrder($id, $data) {
		// var_dump($id, $data);exit;
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_etsy_order');
        $builder->where('id', $id);
        $builder->update($data);
		return TRUE;
    }
}