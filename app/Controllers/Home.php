<?php

namespace App\Controllers;


class Home extends BaseController
{

	public function index()
	{
		$pageName = "Home";
        return view("home", compact("pageName"));
		//return view('home');
	}
}
