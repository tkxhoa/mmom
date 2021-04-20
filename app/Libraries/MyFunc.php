<?php

namespace App\Libraries;

class MyFunc
{
    //print array beautifully
    public function print($input)
    {
        echo '<pre>';
        print_r($input);
        echo '</pre>';
    }

    //add activity log into DB
    public function addActivityLog($activity, $type) {
        $activityModel = new \App\Models\ActivityModel();
        $rs = $activityModel->addActivity(['activity' => $activity, 'type' => $type]);
    }

    //Make a random string
    function generateRandomString($length = 10, $upercaseOnly=false) {
        $characters = '';
        if ($upercaseOnly) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        } else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}