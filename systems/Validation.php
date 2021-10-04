<?php

namespace Systems;

use Rakit\Validation\Validator;

class Validation
{
    public static function Validate($parameter, $rules, $file = null)
    {
        if ($file['size'][0] > 0) {
            $total = count($file['name']);
            for ($i = 0; $i < $total; $i++) {
                $size = $file['size'][$i];
                if ($size > 1000000)
                    return View::redirect('', ['danger' => 'حجم فایل پیوستی باید حداکثر 1 مگابایت باشد.'], true);
                $type = pathinfo($file['name'][$i], PATHINFO_EXTENSION);
                if (!in_array($type, ['pdf', 'png', 'jpeg', 'jpg']))
                    return View::redirect('', ['danger' => 'نوع فایل پیوستی معتبر نیست'], true);
            }
        }
        $validator = new Validator();

        $validator->setMessages([
            'required' => ' وارد کردن :attribute الزامی است.',
            'numeric' => ':attribute  باید از نوع عددی باشد.',
            'min:6' => ':attribute وارد شده باید حداقل حاوی 6 کاراکتر باشد.',
            'email' => ':attribute وارد شده معتبر نیست.',
            'same:password' => ':attribute وارد شده مطابق نیست.',
        ]);
        $validation = $validator->make($parameter, $rules);
        $validation->setAliases(['phone' => ' شماره تلفن',
            'password'=>'پسورد',
            'name'=>'نام',
            'email'=>'ایمیل',
            'confirm-password'=>'پسوردهای ',
            'bug_virtual_number'=>'شماره مجازی',
            'bug_description'=>'توضیحات',
            'user_type_customer'=>'نوع مشتری',
            'national_code'=>'کد ملی',
            'company'=>'نام شرکت',
            'namayande'=>'نام نماینده',
            'phone_namayande'=>'شماره موبایل نماینده',
            'activity'=>'زمینه فعالیت',
            'payment_amount'=>'هزینه کارشناسی',
            'request_count_unit'=>'تعداد واحد',
            'request_count_request'=>'تعداد درخواست شما',
            'request_build_request'=>'تعداد متقاضی در ساختمان',
            'request_address'=>'آدرس دقیق برای کارشناسی',
            'request_fix_number'=>'شماره تلفن ثابت',

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

    }
}