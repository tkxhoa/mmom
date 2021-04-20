<?php

namespace App\Models;

use CodeIgniter\Model;

class EtsyOrderSummaryModel extends Model
{
    
	public function getCurrentMonth($period='this_month') {
		$conditions = array(
			'this_month' => 'sale_year = YEAR(CURRENT_DATE) AND sale_month = MONTH(CURRENT_DATE)',
			'last_month' => 'sale_year = YEAR(CURRENT_DATE) AND sale_month = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)',
			'30_days' => 'sale_full_year BETWEEN NOW() - INTERVAL 30 DAY AND NOW()',
			'this_week' => 'sale_week = YEARWEEK(CURRENT_DATE, 5)',
			'last_week' => 'sale_week = YEARWEEK(CURRENT_DATE - INTERVAL 1 WEEK, 5)',
			'this_year' => 'sale_yyyy = DATE_FORMAT(CURRENT_DATE, "%Y")',
			'last_year' => 'sale_yyyy = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, "%Y")'
		);

		$groupBy = array(
			'this_month' => 'sale_date',
			'last_month' => 'sale_date',
			'30_days' => 'sale_date',
			'this_week' => 'sale_date',
			'last_week' => 'sale_date',
			'this_year' => 'sale_ym',
			'last_year' => 'sale_ym'
		);

		$sql = 'SELECT YEAR(STR_TO_DATE(sale_date, "%m/%d/%Y")) as sale_year, 
			MONTH(STR_TO_DATE(sale_date, "%m/%d/%Y")) as sale_month, 
			DAY(STR_TO_DATE(sale_date, "%m/%d/%Y")) as sale_day, 
			YEARWEEK(STR_TO_DATE(sale_date, "%m/%d/%Y"), 5) as sale_week, 
			STR_TO_DATE(sale_date, "%m/%d/%Y") as sale_full_year,
			DATE_FORMAT(STR_TO_DATE(sale_date, "%m/%d/%Y"), "%m-%d") as sale_md,
			DATE_FORMAT(STR_TO_DATE(sale_date, "%m/%d/%Y"), "%Y") as sale_yyyy,
			DATE_FORMAT(STR_TO_DATE(sale_date, "%m/%d/%Y"), "%Y-%m-%d") as sale_ymd,
			DATE_FORMAT(STR_TO_DATE(sale_date, "%m/%d/%Y"), "%Y-%m") as sale_ym,
			sale_date,
			SUM(`item_total`) as items_total, SUM(quantity) as qty, deleted_flg, canceled_flg
			FROM `tbl_etsy_order` 
			GROUP BY ' . $groupBy[$period] . '
			HAVING   deleted_flg = 0 AND canceled_flg = 0
				AND ' . $conditions[$period] . 
			' ORDER BY sale_ymd DESC'
		;
// echo $sql; exit;
		$db = \Config\Database::connect();
        $query = $this->db->query($sql);
			
        $results = $query->getResult();
	    return $results;
	}

	public function getCurrentMonthShopOrder($period='this_month') {
		$conditions = array(
			'this_month' => 'sale_year = YEAR(CURRENT_DATE) AND sale_month = MONTH(CURRENT_DATE)',
			'last_month' => 'sale_year = YEAR(CURRENT_DATE) AND sale_month = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)',
			'30_days' => 'sale_full_year BETWEEN NOW() - INTERVAL 30 DAY AND NOW()',
			'this_week' => 'sale_week = YEARWEEK(CURRENT_DATE, 5)',
			'last_week' => 'sale_week = YEARWEEK(CURRENT_DATE - INTERVAL 1 WEEK, 5)',
			'this_year' => 'sale_yyyy = DATE_FORMAT(CURRENT_DATE, "%Y")',
			'last_year' => 'sale_yyyy = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, "%Y")'
		);

		$groupBy = array(
			'this_month' => '',
			'last_month' => '',
			'30_days' => '',
			'this_week' => '',
			'last_week' => '',
			'this_year' => ',sale_yyyy',
			'last_year' => ',sale_yyyy'
		);
		

		$sql = 'SELECT shop_name, YEAR(STR_TO_DATE(sale_date, "%m/%d/%Y")) as sale_year, 
			MONTH(STR_TO_DATE(sale_date, "%m/%d/%Y")) as sale_month, 
			DAY(STR_TO_DATE(sale_date, "%m/%d/%Y")) as sale_day, 
			YEARWEEK(STR_TO_DATE(sale_date, "%m/%d/%Y"), 5) as sale_week, 
			STR_TO_DATE(sale_date, "%m/%d/%Y") as sale_full_year,
			DATE_FORMAT(STR_TO_DATE(sale_date, "%m/%d/%Y"), "%m-%d") as sale_md,
			DATE_FORMAT(STR_TO_DATE(sale_date, "%m/%d/%Y"), "%Y") as sale_yyyy,
			DATE_FORMAT(STR_TO_DATE(sale_date, "%m/%d/%Y"), "%Y/%m/%d") as sale_ymd,
			sale_date,
			SUM(`item_total`) as items_total, SUM(quantity) as qty, deleted_flg, canceled_flg
			FROM `tbl_etsy_order` 
			GROUP BY shop_name' . $groupBy[$period] . '
			HAVING deleted_flg = 0 AND canceled_flg = 0
				AND ' . $conditions[$period] . 
			' ORDER BY sale_ymd DESC'
		;
// echo $sql; exit;
		$db = \Config\Database::connect();
        $query = $this->db->query($sql);
			
        $results = $query->getResult();
	    return $results;
	}
	
}