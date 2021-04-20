<?php

namespace App\Controllers;

class PaypalTransaction extends BaseController
{
        protected $arrColumnNames = array(
                'Date',
                'Time',
                'TimeZone',
                'Name',
                'Type',
                'Status',
                'Currency',
                'Gross',
                'Fee',
                'Net',
                'From Email Address',
                'To Email Address',
                'Transaction ID',
                'Shipping Address',
                'Address Status',
                'Item Title',
                'Item ID',
                'Shipping and Handling Amount',
                'Insurance Amount',
                'Sales Tax',
                'Option 1 Name',
                'Option 1 Value',
                'Option 2 Name',
                'Option 2 Value',
                'Reference Txn ID',
                'Invoice Number',
                'Custom Number',
                'Quantity',
                'Receipt ID',
                'Balance',
                'Address Line 1',
                'Address Line 2',
                'City',
                'State',
                'Postal Code',
                'Country',
                'Contact Phone Number',
                'Subject',
                'Note',
                'Country Code',
                'Balance Impact'
        );

        protected $arrColumnKeys = array(
                'date',
                'time',
                'timezone',
                'name',
                'type',
                'status',
                'currency',
                'gross',
                'fee',
                'net',
                'from_email_address',
                'to_email_address',
                'transaction_id',
                'shipping_address',
                'address_status',
                'item_title',
                'item_id',
                'shipping_and_handling_amount',
                'insurance_amount',
                'sales_tax',
                'option_1_name',
                'option_1_value',
                'option_2_name',
                'option_2_value',
                'reference_txn_id',
                'invoice_number',
                'custom_number',
                'quantity',
                'receipt_id',
                'balance',
                'address_line_1',
                'address_line_2',
                'town/city',
                'state',
                'postal_code',
                'country',
                'contact_phone_number',
                'subject',
                'note',
                'country_code',
                'balance_impact'
        );

        public function index()
        {
                $params = [];
                $paypal = $this->request->getVar('paypal');

                if ($paypal) {
                        $params[] = "paypal_email = '{$paypal}'";
                }

                // Create a new class manually
                $ppTransactionModel = new \App\Models\PaypalTransactionModel();
                $results = $ppTransactionModel->getAll($params);

                $ppModel = new \App\Models\PaypalModel();
                $listPaypalEmail = $ppModel->getAllPaypalEmail();
                // $this->myFunc->print($listEtsy);

                $pageName = "Paypal Trasaction Management";
                $showMenu = 'paypal';

                return view("paypal_transaction", compact(
                        'pageName', 'results', 
                        'listPaypalEmail', 'paypal',
                        'showMenu'
                ));
        }

        public function importcsv() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $file = $this->request->getFile("csv_file");
                        $ppEmail = $this->request->getVar("paypal");
                        $file_name = $file->getTempName();

                        $errors = [];
                        if (empty($file_name)) {
                                $errors[] = 'Select file please!';
                        }

                        if (empty($ppEmail)) {
                                $errors[] = 'Select a paypal account!';
                        }

                        $filename = $_FILES['csv_file']['name'];

                        if (empty($errors) && !str_starts_with($filename, 'Paypal-' . $ppEmail)) {
                                $errors[] = 'CSV File Name and Paypal Email do not match!';
                        }

                        if (!empty($errors)) {
                                $session = session();
                                $session->setFlashdata('errors', $errors);
                                return redirect()->route('paypaltransaction');
                        }

                        if ($file_name && $ppEmail) {
                                $csvData = array_map('str_getcsv', file($file_name));
                                $ppTranModel = new \App\Models\PaypalTransactionModel();
                                $ppTranModel->importCSV($csvData, $ppEmail);
                                $this->myFunc->addActivityLog('Import Paypal transactions. File: ' . $filename, 'paypal');
                        }

                        // return redirect()->route('paypaltransaction');
                }
                return redirect()->route('paypaltransaction');
        }

}
