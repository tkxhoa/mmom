<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductSummaryModel extends Model
{
    
	public function getCurrentMonth($period='this_month') {
		$conditions = array(
			'this_month' => 'created_year = YEAR(CURRENT_DATE) AND created_month = MONTH(CURRENT_DATE)',
			'last_month' => 'created_year = YEAR(CURRENT_DATE) AND created_month = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)',
			'30_days' => 'created_full_year BETWEEN NOW() - INTERVAL 30 DAY AND NOW()',
			'this_week' => 'created_week = YEARWEEK(CURRENT_DATE, 5)',
			'last_week' => 'created_week = YEARWEEK(CURRENT_DATE - INTERVAL 1 WEEK, 5)',
			'this_year' => 'created_yyyy = DATE_FORMAT(CURRENT_DATE, "%Y")',
			'last_year' => 'created_yyyy = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, "%Y")'
		);

		$groupBy = array(
			'this_month' => 'created_ymd',
			'last_month' => 'created_ymd',
			'30_days' => 'created_ymd',
			'this_week' => 'created_ymd',
			'last_week' => 'created_ymd',
			'this_year' => 'created_ym',
			'last_year' => 'created_ym'
		);

		$sql = 'SELECT YEAR(created_date) as created_year, 
			MONTH(created_date) as created_month, 
			DAY(created_date) as created_day, 
			YEARWEEK(created_date, 5) as created_week, 
			created_date as created_full_year,
			DATE_FORMAT(created_date, "%m-%d") as created_md,
			DATE_FORMAT(created_date, "%Y") as created_yyyy,
			DATE_FORMAT(created_date, "%Y-%m-%d") as created_ymd,
			DATE_FORMAT(created_date, "%Y-%m") as created_ym,
			created_date,
			COUNT(id) as qty, deleted_flg
			FROM `tbl_product` 
			GROUP BY ' . $groupBy[$period] . '
			HAVING   deleted_flg = 0
				AND ' . $conditions[$period] . 
			' ORDER BY created_ymd DESC'
		;
// echo $sql; exit;
		$db = \Config\Database::connect();
        $query = $this->db->query($sql);
			
        $results = $query->getResult();
	    return $results;
	}

	public function getCurrentMonthShopOrder($period='this_month') {
		$conditions = array(
			'this_month' => 'created_year = YEAR(CURRENT_DATE) AND created_month = MONTH(CURRENT_DATE)',
			'last_month' => 'created_year = YEAR(CURRENT_DATE) AND created_month = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)',
			'30_days' => 'created_full_year BETWEEN NOW() - INTERVAL 30 DAY AND NOW()',
			'this_week' => 'created_week = YEARWEEK(CURRENT_DATE, 5)',
			'last_week' => 'created_week = YEARWEEK(CURRENT_DATE - INTERVAL 1 WEEK, 5)',
			'this_year' => 'created_yyyy = DATE_FORMAT(CURRENT_DATE, "%Y")',
			'last_year' => 'created_yyyy = DATE_FORMAT(CURRENT_DATE - INTERVAL 1 YEAR, "%Y")'
		);

		$groupBy = array(
			'this_month' => ',created_year,created_month',
			'last_month' => ',created_year,created_month',
			'30_days' => '',
			'this_week' => ',created_week',
			'last_week' => ',created_week',
			'this_year' => ',created_yyyy',
			'last_year' => ',created_yyyy'
		);
		

		$sql = 'SELECT kind, YEAR(created_date) as created_year, 
			MONTH(created_date) as created_month, 
			DAY(created_date) as created_day, 
			YEARWEEK(created_date, 5) as created_week, 
			created_date as created_full_year,
			DATE_FORMAT(created_date, "%m-%d") as created_md,
			DATE_FORMAT(created_date, "%Y") as created_yyyy,
			DATE_FORMAT(created_date, "%Y-%m-%d") as created_ymd,
			created_date,
			COUNT(id) as qty, deleted_flg
			FROM `tbl_product` 
			GROUP BY kind' . $groupBy[$period] . '
			HAVING deleted_flg = 0
				AND ' . $conditions[$period] . 
			' ORDER BY created_ymd DESC'
		;
// echo $sql; exit;
		$db = \Config\Database::connect();
        $query = $this->db->query($sql);
			
        $results = $query->getResult();
	    return $results;
	}
	
}