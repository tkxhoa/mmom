<?php

namespace App\Controllers;

class EtsyOrder extends BaseController
{
        protected $arrColumnNames = array(
                'Sale Date',
                'Item Name',
                'Buyer',
                'Quantity',
                'Price',
                'Coupon Code',
                'Coupon Details',
                'Discount Amount',
                'Shipping Discount',
                'Order Shipping',
                'Order Sales Tax',
                'Item Total',
                'Currency',
                'Transaction ID',
                'Listing ID',
                'Date Paid',
                'Date Shipped',
                'Ship Name',
                'Ship Address1',
                'Ship Address2',
                'Ship City',
                'Ship State',
                'Ship Zipcode',
                'Ship Country',
                'Order ID',
                'Variations',
                'Order Type',
                'Listings Type',
                'Payment Type',
                'InPerson Discount',
                'InPerson Location',
                'VAT Paid by Buyer'
        );

        protected $arrColumnKeys = array(
                'sale_date',
                'item_name',
                'buyer',
                'quantity',
                'price',
                'coupon_code',
                'coupon_details',
                'discount_amount',
                'shipping_discount',
                'order_shipping',
                'order_sales_tax',
                'item_total',
                'currency',
                'transaction_id',
                'listing_id',
                'date_paid',
                'date_shipped',
                'ship_name',
                'ship_address1',
                'ship_address2',
                'ship_city',
                'ship_state',
                'ship_zipcode',
                'ship_country',
                'order_id',
                'variations',
                'order_type',
                'listings_type',
                'payment_type',
                'inperson_discount',
                'inperson_location',
                'vat_paid_by_buyer',
                'sku'
        );

        public function index()
        {
                $params = [];
                $shopName = $this->request->getVar('shop_name');
                $fulfilledFlg = $this->request->getVar('fulfilled_flg');
                $shippedFlg = $this->request->getVar('shipped_flg');
                
                if ($shopName) {
                        $params[] = "etsy_order.shop_name = '{$shopName}'";
                }

                if ($fulfilledFlg === '0' || $fulfilledFlg === '1') {
                        $params[] = "etsy_order.fulfilled_flg = {$fulfilledFlg}";
                }

                if ($shippedFlg != '1') {//unchecked
                        $params[] = "etsy_order.shipped_flg = 0";
                }

                // Create a new class manually
                $etsyOrderModel = new \App\Models\EtsyOrderModel();
                $results = $etsyOrderModel->getAll($params);
                // $this->myFunc->print($results);

                $etsyModel = new \App\Models\EtsyModel();
                $listEtsy = $etsyModel->getAllShopNames();
                // $this->myFunc->print($listEtsy);

                $pageName = "Etsy Order Management";
                $showMenu = 'etsy';

                return view("etsy_order", compact('pageName', 'results', 
                        'listEtsy', 'shopName', 'fulfilledFlg', 'shippedFlg',
                        'showMenu'
                ));
        }

        public function importcsv() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $file = $this->request->getFile("csv_file");
                        $shopName = $this->request->getVar("shop_name");
                        $file_name = $file->getTempName();

                        $errors = [];
                        if (empty($file_name)) {
                                
                                $errors[] = 'Select file please!';
                        }

                        if (empty($shopName)) {
                                $errors[] = 'Select a shop!';
                        }

                        $filename = $_FILES['csv_file']['name'];

                        //EtsySoldOrderItems-Dachtx-01.04.21~16.04.21.csv
                        if (empty($errors) && !str_starts_with($filename, 'EtsySoldOrderItems-' . $shopName)) {
                                $errors[] = 'CSV File Name and Shop Name do not match!';
                        }

                        if (!empty($errors)) {
                                $session = session();
                                $session->setFlashdata('errors', $errors);
                                return redirect()->route('etsy_orders');
                        }

                        if ($file_name && $shopName) {
                                $csvData = array_map('str_getcsv', file($file_name));
                                $etsyOrderModel = new \App\Models\EtsyOrderModel();
                                $etsyOrderModel->importCSV($csvData, $shopName);
                                $this->myFunc->addActivityLog('Import Etsy Orders. File: ' . $filename, 'etsy');
                        }
                }
                return redirect()->route('etsy_orders');
        }

        public function updateFulfill() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $orderIds = trim($this->request->getVar('order_ids'));
                        // $this->myFunc->print($orderIds);

                        // $arrOrderIds = explode(",", $orderIds);
                        $arrOrderIds = preg_split("/[\s,]+/", $orderIds);
                        // $this->myFunc->print($arrOrderIds);exit;
                        
                        // $this->myFunc->print($trimmed_array);exit;

                        $etsyOrderModel = new \App\Models\EtsyOrderModel();
                        $etsyOrderModel->updateFulfilledFlg($arrOrderIds);

                        return redirect()->route('etsy_orders');
                }
        }

        public function updateTracking() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $orderIds = $this->request->getVar('order_ids');
                        // $this->myFunc->print($orderIds);

                        // $arrOrderIds = explode(",", $orderIds);
                        $arrOrderIds = preg_split("/[\s,]+/", $orderIds);
                        // $this->myFunc->print($arrOrderIds);
                        $trimmed_array = array_map('trim', $arrOrderIds);
                        if ($trimmed_array[count($trimmed_array) -1] === '')
                        {
                                array_pop($trimmed_array);
                        }
                        // $this->myFunc->print($trimmed_array);exit;

                        $etsyOrderModel = new \App\Models\EtsyOrderModel();
                        $etsyOrderModel->updateTrackingFlg($arrOrderIds);

                        return redirect()->route('etsy_orders');
                }
        }

        public function updateShipped() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $orderIds = $this->request->getVar('order_ids');
                        // $this->myFunc->print($orderIds);

                        // $arrOrderIds = explode(",", $orderIds);
                        $arrOrderIds = preg_split("/[\s,]+/", $orderIds);
                        // $this->myFunc->print($arrOrderIds);
                        $trimmed_array = array_map('trim', $arrOrderIds);
                        if ($trimmed_array[count($trimmed_array) -1] === '')
                        {
                                array_pop($trimmed_array);
                        }
                        // $this->myFunc->print($trimmed_array);exit;

                        $etsyOrderModel = new \App\Models\EtsyOrderModel();
                        $etsyOrderModel->updateShippedFlg($arrOrderIds);

                        return redirect()->route('etsy_orders');
                }
        }

        
        function exportCSVFulfill() {
                $params = [];
                $shopName = $this->request->getVar('shop_name');
                
                if ($shopName) {
                        $params[] = "shop_name = '{$shopName}'";
                } else {
                        $session = session();
                        $session->setFlashdata('errors', ['Please select a shop!']);
                        return redirect()->route('etsy_orders');
                }

                // Create a new class manually
                $etsyOrderModel = new \App\Models\EtsyOrderModel();
                $results = $etsyOrderModel->getAllNotFulfil($params);
                if (empty($results)) {
                        $session = session();
                        $session->setFlashdata('errors', ['No data to export csv']);
                        return redirect()->route('etsy_orders');
                }

                // file name 
                $filename = 'csv-etsy-orders-'.date('Ymd').'.csv'; 
                header("Content-Description: File Transfer"); 
                header("Content-Disposition: attachment; filename=$filename"); 
                header("Content-Type: application/csv; ");
                
                // file creation 
                $file = fopen('php://output', 'w');

                $header = $this->arrColumnNames; 

                fputcsv($file, $header);

                foreach ($results as $row) {
                        $rowValues = [];
                        foreach ($this->arrColumnKeys as $key) {
                                $rowValues[] = $row->{$key};
                        }
                        fputcsv($file, $rowValues);
                }
                fclose($file); 
                exit; 
        }


        public function update() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $id = $this->request->getVar("id");
                        $field = $this->request->getVar("field");
                        $value = $this->request->getVar("value");
                       
                        $data = array(
                                $field => $value
                        );

                        $etsyOrderModel = new \App\Models\EtsyOrderModel();
                        $etsyOrderModel->updateEtsyOrder($id, $data);
                }
        }
}
