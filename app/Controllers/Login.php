<?php

namespace App\Controllers;

class Login extends BaseController
{
	public function index()
    {
        helper(['form']);
        echo view('login');
    } 
  
    public function auth()
    {
        $session = session();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        if($email == 'txkhoa@gmail.com' && $password == 'Khoa$2021'){
            $ses_data = [
				'email'     	=> $email,
				'logged_in'     => TRUE
			];
			$session->set($ses_data);
			return redirect()->to('/');
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }
  
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
