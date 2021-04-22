<?php

namespace App\Controllers;

class ProductSummary extends BaseController
{
        public function index()
        {
                $pageName = "Product Summary";
                $jsList = array(
                        'js/charts/product_summary_bar_chart.js',
                        'js/charts/product_summary_pie_chart.js',
                );

                // this_month
                // last_month
                // 30_days
                $period = $this->request->getVar('period');
                if(empty($period)) {
                        $period = 'this_month';
                }

                $productSummaryModel = new \App\Models\ProductSummaryModel();
                $currentMonthData = $productSummaryModel->getCurrentMonth($period);
                // $this->myFunc->print($currentMonthData);

                $currentMonthShopData = $productSummaryModel->getCurrentMonthShopOrder($period);
                // $this->myFunc->print($currentMonthShopData);
                
                //bar chart group by created date
                $arrCreatedDates = [];
                $maxItemsTotal = 0;
                $maxQty = 0;

                $today = date('Y-m-d');

                $totalQuantity = 0;
                $arrCreatedDates = [];
                $arrQtyTotal = [];

                switch ($period) {
                        case 'last_week':
                        case 'this_week':
                                $arrWeeks = [
                                        'last_week' => 'last week',
                                        'this_week' => 'this week'
                                ];

                                $firstdayYMD = date('Y-m-d', strtotime($arrWeeks[$period]));
                                $firstdayM = date('m', strtotime($arrWeeks[$period]));
                                $firstdayMD = date('m-d', strtotime($arrWeeks[$period]));
                                $firstdayD = intval(date('d', strtotime($arrWeeks[$period])));
  
                                $pageName .= ': ' . ucwords($arrWeeks[$period]) . '(' . $firstdayMD;
                                $index = 0;
                                while ($index < 7) {
                                        $strMD = $firstdayM . '-' . str_pad($index + $firstdayD, 2, "0", STR_PAD_LEFT);
                                        $strMDDisplay = str_pad($index + $firstdayD, 2, "0", STR_PAD_LEFT);
                                        $arrCreatedDates[] = $strMDDisplay;
                                        $arrQtyTotal[$strMD] = 0;
                                        $index++;
                                }
                                $pageName .= ' ~ ' . $strMD . ')';
                                break;

                        case 'this_month':
                                $pageName .= ': This Month(' . date("Y-m", strtotime($today)) . ')';

                                $lastDayThisMonth = intval(date("t", strtotime($today)));
                                for ($d = 1; $d <= $lastDayThisMonth; $d++) {
                                        $strMD = date("m-", strtotime($today)) . str_pad($d, 2, "0", STR_PAD_LEFT);
                                        $strMDDisplay = str_pad($d, 2, "0", STR_PAD_LEFT);
                                        $arrCreatedDates[] = $strMDDisplay;
                                        $arrQtyTotal[$strMD] = 0;
                                }
                                break;
                        
                        case 'last_month':
                                $pageName .= ': Last Month(' . date('Y-m', strtotime('last day of previous month')) . ')';
                                // $lastDayOfLastMonthYM = date('Y-m-', strtotime('last day of previous month'));
                                $lastDayOfLastMonthD = intval(date('d', strtotime('last day of previous month')));
                                $lastDayOfLastMonthM = date('m', strtotime('last day of previous month'));
                                for ($d = 1; $d <= $lastDayOfLastMonthD; $d++) {
                                        $strMD = $lastDayOfLastMonthM . '-' . str_pad($d, 2, "0", STR_PAD_LEFT);
                                        $strMDDisplay = str_pad($d, 2, "0", STR_PAD_LEFT);
                                        $arrCreatedDates[] = $strMDDisplay;
                                        $arrQtyTotal[$strMD] = 0;
                                }
                                break;

                        case '30_days':
                                // echo date('Y-m-d', strtotime('today - 30 days'));exit;
                                $last30DaysM = date('m', strtotime('today - 30 days'));
                                $last30DaysFirstD = intval(date('d', strtotime('today - 30 days'))) + 1;
                                $last30DaysLasttD = intval(date('t', strtotime('today - 30 days')));

                                $pageName .= ': Last 30 days(' . $last30DaysM . str_pad($last30DaysFirstD, 2, "0", STR_PAD_LEFT);
                                //last month
                                $count = 0;
                                for ($d = $last30DaysFirstD; $d <= $last30DaysLasttD; $d++) {
                                        $strMD = $last30DaysM . '-' . str_pad($d, 2, "0", STR_PAD_LEFT);
                                        // $strMDDisplay = $last30DaysM . '/' . str_pad($d, 2, "0", STR_PAD_LEFT);
                                        $strMDDisplay = str_pad($d, 2, "0", STR_PAD_LEFT);
                                        $arrCreatedDates[] = $strMDDisplay;
                                        $arrQtyTotal[$strMD] = 0;
                                        $count++;
                                }

                                //this month
                                $dateThisMonth = 1;
                                $strMD = '';
                                while ($count < 30)
                                {
                                        // date("Y-m-", strtotime($today)) . $dateThisMonth;
                                        $strMD = date("m-", strtotime($today)) . str_pad($dateThisMonth, 2, "0", STR_PAD_LEFT);

                                        if ($dateThisMonth == 1) {
                                                $strMDDisplay = str_pad($dateThisMonth, 2, "0", STR_PAD_LEFT) . date("/m", strtotime($today));
                                        } else {
                                                $strMDDisplay = str_pad($dateThisMonth, 2, "0", STR_PAD_LEFT);
                                        }

                                        $arrCreatedDates[] = $strMDDisplay;
                                        $arrQtyTotal[$strMD] = 0;
                                        $count++;
                                        $dateThisMonth++;
                                }

                                $pageName .= ' ~ ' . $strMD . ')';
                                
                                break;  
                                
                                case 'this_year':
                                case 'last_year':                                      
                                        $arrayY = array(
                                                'this_year' => date("Y", strtotime($today)),
                                                'last_year' => date("Y",strtotime("-1 year")),
                                        );
                                        $firstMonthY = $arrayY[$period];
          
                                        $pageName .= ': ' . $firstMonthY;
                                        for ($m = 1; $m <= 12; $m++) {
                                                $strYM = $firstMonthY . '-' . str_pad($m, 2, "0", STR_PAD_LEFT);
                                                $strYMDisplay = str_pad($m, 2, "0", STR_PAD_LEFT);
                                                $arrCreatedDates[] = $strYMDisplay;
                                                $arrQtyTotal[$strYM] = 0;
                                        }
                                break;
                                                             
                }

                if (!empty($currentMonthData)) {
                        foreach ($currentMonthData as $obj) {
                                
                                if ($obj->qty > $maxQty) {
                                        $maxQty = $obj->qty;
                                }

                                $totalQuantity += $obj->qty;
                                // $arrCreatedDates[] = $obj->created_date;
                                // $dcreatedDate = intval(date("d", strtotime($obj->created_date)));
                                // $createdDate = intval(date("Y-m-d", strtotime($obj->created_date)));
                                // echo '#' . $dcreatedDate;
                                if ($period == 'this_year' || $period == 'last_year') {
                                        $arrQtyTotal[$obj->created_year . '-' . str_pad($obj->created_month, 2, "0", STR_PAD_LEFT)] = $obj->qty;
                                } else {
                                        $arrQtyTotal[$obj->created_md] = $obj->qty;
                                }
                                
                                $maxItemsTotal = ceil($maxItemsTotal/10) * 10;
                        }

                        // $this->myFunc->print($arrQtyTotal);

                }

                //Pie chart group by shop name
                $arrShopNames = [];
                $arrShopItemsTotal = [];
                $arrShopQtyTotal = [];
                
                foreach ($currentMonthShopData as $row) {
                        $arrShopNames[] = $row->kind;
                        $arrShopQtyTotal[] = $row->qty;
                }

                $showMenu = 'product';

                return view("product_summary", compact(
                        'pageName', 'jsList', 'arrCreatedDates',  
                        'maxItemsTotal',
                        'maxQty', 'arrQtyTotal', 'totalQuantity',
                        'period',
                        'arrShopNames', 'arrShopItemsTotal', 'arrShopQtyTotal',
                        'showMenu'
                ));
        }

}
