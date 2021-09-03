<?php

namespace Models;

use Systems\Url;
use Systems\Auth;
use Hekmatinasser\Verta\Verta;

class File
{
    const primary='file_id',
          table='files';
    public static function find($id)
    {
        $qb=QB::getInstance();
        $user=$qb->table(self::table)->where(self::primary,$id)->QGet();
        return $user[0];
    }

    /*public static function custom_input($id,$input){
        $res=[];
        foreach (self::fillable as $record){
            $res[$record]=$input[$record];
            $res[Request::primary]=$id;
        }
        return $res;
    }*/

    public static function upload($file){

    }

    public function deletefile($file_id)
    {
        $file=File::find($file_id);
        if(file_exists(Url::storage_path().'/'.$file['file_path']))
            unlink(Url::storage_path().'/'.$file['file_path']);
        $QB=QB::getInstance();
        $QB->delete(File::table)->where(File::primary,$file_id)->exec();
        return response()->json(['success'=>true]);
    }

    public static function manege_name_for_upload($name,$file)
    {
        $user_id = Auth::id();
        $guessExtension= pathinfo($name, PATHINFO_EXTENSION);
        $title = $user_id . '_' . md5_file($file) . '.' . $guessExtension;
        return $title;
    }

    public static function compressImage($source, $destination, $quality)
    {
        // Get image info
        $imgInfo = getimagesize($source);
        $mime = $imgInfo['mime'];

        // Create a new image from file
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                $image = imagecreatefromjpeg($source);
        }

        // Save image
        imagejpeg($image, $destination, $quality);

        // Return compressed image
        return $destination;
    }

    public static function valid_image_type($title)
    {
        $valid_ext = array('png', 'jpeg', 'jpg');
        // file extension
        $fileType = pathinfo($title, PATHINFO_EXTENSION);
        $fileType = strtolower($fileType);
        if (in_array($fileType, $valid_ext))
            return true;
        return false;
    }

    public static function manege_path_for_upload()
    {
        $date = Verta();
        $year = $date->year;
        $month = $date->month;
        $user_upload_path = Url::storage_path();
        if (!is_dir("$user_upload_path$year"))
            mkdir("$user_upload_path$year");
        if (!is_dir($user_upload_path . $year .'/'. $month))
            mkdir($user_upload_path . $year .'/'. $month);
        $path = $user_upload_path . $year .'/'. $month;
        return $path;
    }



}