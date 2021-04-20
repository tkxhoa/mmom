<?php

namespace App\Models;

use CodeIgniter\Model;

class MyBaseModel extends Model
{
    public function print($input)
    {
        echo '<pre>';
        print_r($input);
        echo '</pre>';
    }

    //Make a random string
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}