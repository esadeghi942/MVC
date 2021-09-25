<?php

namespace Models;

use Carbon\Carbon;
use Systems\Url;
use Systems\Auth;
use Hekmatinasser\Verta\Verta;
use Systems\View;

class File extends BaseModel
{
    const primary = 'file_id',
        table = 'files',
        timecreate = 'file_create';

    /*public static function custom_input($id,$input){
        $res=[];
        foreach (self::fillable as $record){
            $res[$record]=$input[$record];
            $res[Request::primary]=$id;
        }
        return $res;
    }*/

    public function delete()
    {
        $file = self::find();
        if (file_exists($file->file_path))
            unlink($file->file_path);
        return parent::delete();
    }

    public function manege_name_for_upload($name, $file,$custom=null)
    {
        $user_id = Auth::id();
        $guessExtension = pathinfo($name, PATHINFO_EXTENSION);
        if(isset($custom)) {
            $custom=preg_replace("/[^a-zA-Z0-9\-\._]/", '', $custom);
            $title = $custom . '.' . $guessExtension;
        }
        else
            $title = $user_id . '_' . md5_file($file) . '.' . $guessExtension;
        return $title;
    }

    public function compressImage($source, $destination, $quality)
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

    public function valid_image_type($title)
    {
        $valid_ext = array('png', 'jpeg', 'jpg');
        // file extension
        $fileType = pathinfo($title, PATHINFO_EXTENSION);
        $fileType = strtolower($fileType);
        if (in_array($fileType, $valid_ext))
            return true;
        return false;
    }

    public function manege_path_for_upload($model)
    {
        $date = Verta();
        $year = $date->year;
        $month = $date->month;
        $user_upload_path = Url::storage_path();
        if (!is_dir("$user_upload_path$model"))
            mkdir("$user_upload_path$model");
        if (!is_dir("$user_upload_path$model/$year"))
            mkdir("$user_upload_path$model/$year");
        if (!is_dir("$user_upload_path$model/$year/$month"))
            mkdir("$user_upload_path$model/$year/$month");
        $path = "$user_upload_path$model/$year/$month/";
        return $path;
    }

    public function upload_file($file, $model_id, $model,$customfilename=null)
    {
        $total = count($file['name']);
        $path = self::manege_path_for_upload($model);
        $id_insert=[];
        for ($i = 0; $i < $total; $i++) {
            $size = $file['size'][$i];
            if($size == 0 || empty($customfilename[$i]))
                continue;
            $title = $file['name'][$i];
            $tmp = $file["tmp_name"][$i];
            $file_name = self::manege_name_for_upload($file["name"][$i], $file["tmp_name"][$i]);
            $UploadPath = $path . $file_name;
            //check image type to reduce quality
            if (self::valid_image_type($title)) {
                $res = self::compressImage($tmp, $UploadPath, 50);
                if (!$res)
                    return View::redirect('', ['danger' => 'مشکلی در ذخیره فایل پیوستی به وجود آمده'], true,['inserted'=>$id_insert]);
            } else
                move_uploaded_file($tmp, $path . $file_name);
            $date = Carbon::now()->toDateTimeString();
            if(!empty($customfilename[$i]))
                $title=$customfilename[$i];
            $inputs = [
                'file_title' => $title,
                'file_model' => $model,
                'file_size' => $size,
                'file_path' => $UploadPath,
                'model_id' => $model_id,
                'file_create' => $date
            ];
            $QB=QB::getInstance();
            $file_id=$QB->insert(File::table, $inputs);
            $id_insert[]=$file_id;
        }
    }
}