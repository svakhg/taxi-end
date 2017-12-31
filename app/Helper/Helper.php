<?php
namespace App\Helper;

class Helper
{
    public static function s3_url_gen($location)
    {
        return 'https://s3-ap-southeast-1.amazonaws.com/taviyani/'.$location;
    }
    
    public static function local_url_gen($location)
    {
        return '/'.'image/'.$location;
    }

    public static function slug_gen($str)
    {
        $str = strtolower(trim($str));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        return $str;
    }

    public static function un_slug_gen($str)
    {
        $str = ucfirst(trim($str));
        $str = str_replace("-", " ", $str);
        return $str;
    }
}