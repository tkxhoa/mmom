<?php

namespace App\Controllers;

class Email extends BaseController
{
        public function index()
        {
        // Create a new class manually
        $emailModel = new \App\Models\EmailModel();
        $results = $emailModel->getAll();

        $pageName = "ACTIVITIES";
        return view("email", compact("pageName", 'results'));
        }
}
