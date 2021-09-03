<?php
namespace Controllers\User;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Models\File;
use Models\QB;
use Models\Request;
use Rakit\Validation\Validator;
use Systems\Auth;
use Systems\View;

class UserRequestController
{
    function index(){

    }

    function store(){
        $user = Auth::id();
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'request_count_unit' => 'numeric',
            'request_count_request' => 'numeric',
            'request_build_request' => 'numeric',
        ]);
        $validation->validate();
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errors = $errors->firstOfAll();
            $msg = '';
            foreach ($errors as $error)
                $msg .= "<pre>$error</pre>";
            return View::redirect('', ['danger' => $msg], true);
        }
        $QB = QB::getInstance();
        $req_id=$QB->insert(Request::table,Request::custom_input($user,$_POST));
        if($req_id && !empty($_FILES['request_file']['size']>0))
            self::upload_file($_FILES['request_file'],$req_id);
        return View::redirect('../userRequestIndex', ['success' => 'درخواست با موفقیت ثبت شد.']);
    }

    function edit(){

    }

    function update(){

    }

    function delete(){

    }
    private function upload_file($file,$request_id){
        $total = count($file['name']);
        $path = File::manege_path_for_upload();
        for( $i=0 ; $i < $total ; $i++ ) {
            $size = $file['size'][$i];
            $title = $file['name'][$i];
            $tmp = $file["tmp_name"][$i];
            $file_name = File::manege_name_for_upload($file["name"][$i],$file["tmp_name"][$i]);
            $UploadPath = $path . '/' . $file_name;
            //check image type to reduce quality
            if (File::valid_image_type($title)) {
                $res = File::compressImage($tmp, $UploadPath, 60);
                if (!$res)
                    return View::redirect('',['danger'=>'مشکلی در ذخیره فایل پیوستی به وجود آمده'],true);
            }
            else
                move_uploaded_file($tmp,$path.$file_name);
            $date=Carbon::now()->toDateTimeString();
            $inputs = ['file_title' => $title,
                'file_size' => $size,
                'file_path' => $UploadPath,
                'file_request_id' => $request_id,
                'file_create'=>$date
                ];
            $QB=QB::getInstance();
            $QB->insert(File::table,$inputs);
        }
    }

}