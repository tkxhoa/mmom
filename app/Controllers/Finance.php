<?php

namespace App\Controllers;

class Finance extends BaseController
{
        protected $kindList = array(
                'Transfer',
                'Buy',
                'Withdraw'
        );
        public function index()
        {
                $params = [];
                $session = session();
                $data = $session->get('data');
                var_dump($data);
                $code = $kind = $shop_type = '';
                if (empty($data)) {
                        $code = $this->request->getVar('code');
                        $kind = $this->request->getVar('kind');
                        $shop_type = $this->request->getVar('shop_type');
                        
                        if ($code) {
                                $params[] = "code = '{$code}'";
                        }

                        if ($shop_type) {
                                $params[] = "shop_type = '{$shop_type}'";
                        }
                }

                // Create a new class manually
                $financeModel = new \App\Models\FinanceModel();
                $results = $financeModel->getAll($params);

                $pageName = "Finance";
                $showMenu = 'finance';
                $bank_list = $financeModel->getAllBank();
                $kindList = $this->kindList;
            
                return view("finance", compact('pageName', 'results', 
                        'code', 'bank_list', 'kind', 'shop_type', 'data', 'kindList',
                        'showMenu'
                ));
        }


        public function create() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $account = $this->request->getVar("account");
                        $category = $this->request->getVar("category");
                        $kind = $this->request->getVar("kind");

                        $amount = $this->request->getVar("amount") ?? 0;
                        $currency = $this->request->getVar("currency");
                        $rate = $this->request->getVar("rate");

                        $vnd_amount = $this->request->getVar("vnd_amount") ?? 0;
                        $issue = $this->request->getVar("issue");

                        $fromAccount = $this->request->getVar("from_account");
                        $toAccount = $this->request->getVar("to_account");

                        $data = compact('account', 'category', 'kind', 'amount', 'fromAccount', 'toAccount',
                                'currency', 'rate', 'vnd_amount', 'issue');
                        
                        $account2 = '';        

                        $errors = [];
                        if (empty($account)) {
                                
                                $errors[] = 'Please select an account!';
                        }

                        if (empty($category)) {
                                
                                $errors[] = 'Please input category!';
                        }

                        if (empty($vnd_amount)) {
                                
                                $errors[] = 'Please input VND amount!';
                        }

   
                        if ($kind == 'Transfer') {
                                if (empty($toAccount)) {
                                        $errors[] = 'Please select the dest account';
                                } else if ($account == $toAccount) {
                                        $errors[] = 'From account and To account are the same';
                                }
                                
                        }

                        if ($kind == 'Withdraw' && empty($fromAccount)) {
                                $errors[] = 'Please input the resource account';
                                
                        }

                        $session = session();

                        if (!empty($errors)) {
                                $session->setFlashdata('errors', $errors);
                                $session->setFlashdata('data', $data);
                                return redirect()->route('finance');
                        }


                        $insertData = compact('account', 'category', 'kind', 'amount', 
                                'currency', 'rate', 'vnd_amount', 'issue');

                        $insertData2 = compact('category', 'kind', 'amount', 
                                'currency', 'rate', 'vnd_amount', 'issue');                                

                        //get current balance
                        $financeModel = new \App\Models\FinanceModel();
                        $currentBalance = $financeModel->getCurrentBalance($account);        
                        $this->myFunc->print($currentBalance);

                        $currentBalanceDigital = 0;
                        if (!empty($currentBalance)) {
                                $currentBalanceDigital = $currentBalance[0]->balance;
                        }

                        $impact = '';
                        $balance = $currentBalanceDigital;
                        switch ($kind) {
                                case 'Transfer':
                                        //get the balance of account2 (destination)
                                        $currentBalanceAccount2 = $financeModel->getCurrentBalance($toAccount);        
                                        $this->myFunc->print($currentBalanceAccount2);

                                        $currentBalanceAccount2Digital = 0;
                                        if (!empty($currentBalanceAccount2)) {
                                                $currentBalanceAccount2Digital = $currentBalanceAccount2[0]->balance;
                                        }

                                        # code...
                                        $balance -= $vnd_amount;
                                        $account2 = $toAccount;
                                        $insertData['balance_impact'] = 'Debit';

                                        $insertData2['balance_impact'] = 'Credit';
                                        $insertData2['balance'] =  $currentBalanceAccount2Digital + $vnd_amount;
                                        $insertData2['account'] = $toAccount;
                                        $insertData2['account2'] = $account;
                                        
                                        break;

                                case 'Buy':
                                        # code...
                                        $balance -= $vnd_amount;
                                        $insertData['balance_impact'] = 'Debit';
                                        break; 
                                
                                case 'Withdraw':
                                        $impact = 'Credit';
                                        $balance += $vnd_amount;
                                        $account2 = $fromAccount;
                                        $insertData['balance_impact'] = 'Credit';
                                        break;          
                                
                                default:
                                        # code...
                                        break;
                        }
                        $insertData['balance'] = $balance;
                        
                        $insertData['account2'] = $account2;
                        $this->myFunc->print($insertData);

                        $financeModel->insertTransaction($insertData);

                        if ($kind == 'Transfer') {
                                // $this->myFunc->print($insertData2);
                                $financeModel->insertTransaction($insertData2);
                        }

                        $session->setFlashdata('messages', ['Created Successfully!!']);
                }
                return redirect()->route('finance');
        }
}
