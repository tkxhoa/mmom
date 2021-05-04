<?php

namespace App\Controllers;

class Email extends BaseController
{
        public function index()
        {
                $email = $this->request->getVar('email');

                // Create a new class manually
                $emailModel = new \App\Models\EmailModel();
                $results = $emailModel->getAll($email);

                $pageName = "Email Management";
                return view("email", compact("pageName", 'results', 'email'));
        }
}
