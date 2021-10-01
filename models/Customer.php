<?php

namespace Models;

class Customer extends BaseModel
{
    const table = 'users';
    const haghygi_fillable = ['user_type_customer', 'job', 'familarity', 'national_code'],
        hoghoogi_fillable = ['user_type_customer', 'company', 'namayande', 'sabt_number',
        'ecomonic_number','nathnal_code','phone_namayande','activity'],
        timecreate = User::timecreate,
        primary = User::primary;

    public static function custom_input($input)
    {
        $res = [];
        if ($input['user_type_customer'] == 0)
            foreach (self::haghygi_fillable as $record)
                $res[$record] = $input[$record];

        else if ($input['user_type_customer'] == 1)
            foreach (self::hoghoogi_fillable as $record)
                $res[$record] = $input[$record];

        return json_encode($res);
    }

    public static function defineAttributeValueItem($description)
    {
        $res = [];
        foreach ($description as $k => $i) {
            $str = '';
            $val = $i;
            switch ($k) {
                case 'user_type_customer':
                    $str = 'نوع مشتری';
                    switch ($i) {
                        case 0:
                            $val = 'حقیقی';
                            break;
                        case 1:
                            $val = 'حقوقی';
                            break;
                    }
                    break;
                case 'job':
                    $str = 'شغل';
                    break;
                case 'national_code':
                    $str = 'کد ملی';
                    break;
                case 'familarity':
                    $str = 'نحوه آشنایی';
                    break;
                case 'company':
                    $str = 'نام شرکت';
                    break;
                case 'namayande':
                    $str = 'نام نماینده';
                    break;
                case 'sabt_number':
                    $str = 'شماره ثبت';
                    break;
                case 'ecomonic_number':
                    $str = 'شماره اقتصادی';
                    break;
                case 'nathnal_code':
                    $str = 'شماره ملی';
                    break;
                case 'phone_namayande':
                    $str = 'شماره نماینده';
                    break;
                case 'activity':
                    $str = 'زمینه فعالیت';
                    break;
            }
            $res[$str] = $val;
        }
        return $res;
    }

}