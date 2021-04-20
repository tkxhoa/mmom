<?php

namespace App\Controllers;

class Paypal extends BaseController
{
        public function index()
        {
                // Create a new class manually
                $paypalModel = new \App\Models\PaypalModel();
                $results = $paypalModel->getAll();
                // $this->myFunc->print($results);exit;

                $pageName = "Paypal Management";
                $showMenu = 'paypal';

                return view("paypal", compact('pageName', 'results', 'showMenu'));
        }

}
