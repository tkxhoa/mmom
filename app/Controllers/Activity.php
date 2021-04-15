<?php

namespace App\Controllers;

class Activity extends BaseController
{
	public function index()
	{
        // Create a new class manually
        $activityModel = new \App\Models\ActivityModel();
        $results = $activityModel->getAll();

        $pageName = "Email Management";
        return view("activity", compact("pageName", 'results'));
	}
}
