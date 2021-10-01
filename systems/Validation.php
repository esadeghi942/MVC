<?php

namespace Systems;

use Rakit\Validation\Validator;

class Validation
{


    public static function Validate($parameter, $rules,$file=null)
    {
       if(isset($file)){
           $total = count($file['name']);
           for ($i = 0; $i < $total; $i++) {
               $size = $file['size'][$i];
               if( $size > 1000000)
                   return View::redirect('', ['danger' => 'حجم فایل پیوستی باید حداکثر 1 مگابایت باشد.'],true);
                $type = pathinfo($file['name'][$i], PATHINFO_EXTENSION);
                if(!in_array($type,['pdf','png','jpeg','jpg']))
                    return View::redirect('', ['danger' => 'نوع فایل پیوستی معتبر نیست'],true);
           }
       }
        $validator = new Validator();
        $validation = $validator->validate($parameter, $rules);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errors = $errors->firstOfAll();
            $msg = '';
            foreach ($errors as $error)
                $msg .= "<pre>$error</pre>";

            $validation->setMessages(self::fa_message());
            return View::redirect('', ['danger' => $msg], true);
        }
    }
    function fa_message(){
        return[
            'phone:numeric' => 'شماره تلفن وارد شده معتبر نیست',
            //name,email,password,confirm-password
            //numeric,min,required|email|same:password
        ];
    }
}