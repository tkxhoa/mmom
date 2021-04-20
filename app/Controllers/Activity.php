<?php

namespace App\Controllers;

class Activity extends BaseController
{
	public function index()
	{
                // Create a new class manually
                $activityModel = new \App\Models\ActivityModel();
                $results = $activityModel->getAll();

                $pageName = "Activities";
                return view("activity", compact("pageName", 'results'));
	}
    
}
