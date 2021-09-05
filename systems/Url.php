<?php

namespace Systems;

class Url
{
    public static function get($get = null)
    {
        if (isset($_GET[$get])) {
            return $_GET[$get];
        }
        return null;
    }

    public static function storage_path()
    {
        return 'user-uploads/';
    }

    public static function last()
    {
        // $aa = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $uri = $_SERVER['REQUEST_URI'];
        $urls = explode('/', $uri);
        $last = $urls[count($urls) - 2];
        return $last;
    }

    public static function lasts()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $urls = explode('/', $uri);
        array_shift($urls);
        array_shift($urls);
        $imp = implode($urls, '/');
        return $imp;
    }

    public static function baseURL()
    {
        return 'localhost/tehran/';
        //return $_SERVER['HTTP_HOST'];
    }

    public static function vd($d, $vd = false)
    {
        echo '<pre style="direction:ltr; text-align:left">';
        $vd ? var_dump($d) : print_r($d);
        echo '</pre>';
        die();
    }

    public static function reArrayFiles($file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            if (strlen($file_post['name'][$i]) > 0) {
                foreach ($file_keys as $key) {
                    $file_ary[$i][$key] = $file_post[$key][$i];
                }
            }
        }
        return $file_ary;
    }

    public static function response($status, $message)
    {
        echo json_encode(['status' => $status, 'message' => $message]);
    }


}