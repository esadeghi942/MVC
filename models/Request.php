<?php

namespace Models;

use Carbon\Carbon;
use Systems\Auth;
use Systems\View;

class Request extends BaseModel
{
    const table = 'requests',
        primary = 'request_id',
        userfillable = ['request_address', 'request_buildstatus', 'request_owner', 'request_count_unit', 'request_count_request', 'request_build_request', 'request_fix_number', 'request_base', 'request_karshenasi'],
        adminfillable = ['request_answer'];

    /* public function find()
     {
         $qb = QB::getInstance();
         $request = $qb->table(self::table)->where(self::primary, $this->id)->get();
         return $request[0];
     }*/

    public function files()
    {
        $qb = QB::getInstance();
        $request = $qb->table(File::table)->where('file_model', self::table)->
        where('model_id', $this->id)->get();
        return $request;
    }

    public static function custom_input($input, $edit = false)
    {
        $res = [];
        $id=Auth::id();
        $date = Carbon::now()->toDateTimeString();
        $str = $edit ? 'request_update' : 'request_create';
        foreach (self::userfillable as $record) {
            $res[$record] = $input[$record];
            $res[User::primary] = $id;
            $res[$str] = $date;
        }
        return $res;
    }

    public static function defineAttributeValue(MareiCollection $requests)
    {
        foreach ($requests as $request) {
            $str = '';
            switch ($request->request_status) {
                case 0:
                    $str = 'مشاهده نشده';
                    break;
                case 1:
                    $str = 'در حال بررسی';
                    break;
                case 2:
                    $str = 'اعلام نتیجه';
                    break;
            }
            $request->request_status = $str;
            $str = '';
            switch ($request->request_buildstatus) {
                case 0:
                    $str = ' درحال ساخت';
                    break;
                case 1:
                    $str = 'در حال بازسازی ';
                    break;
                case 2:
                    $str = 'نوساز ';
                    break;
                case 3:
                    $str = ' عمر تا 10 سال';
                    break;
                case 4:
                    $str = 'بیشتر از 10 سال ';
                    break;
            }
            $request->request_buildstatus = $str;
            $str = '';
            switch ($request->request_owner) {
                case 0:
                    $str = 'مالک';
                    break;
                case 1:
                    $str = 'اجاره ای';
                    break;
            }
            $request->request_owner = $str;
            $str = '';
            switch ($request->request_base) {
                case 0:
                    $str = 'در ساختمان وجود دارد';
                    break;
                case 1:
                    $str = 'در واحد پریز فیبر نوری وجود دارد';
                    break;
                case 2:
                    $str = 'در کوچه باکس فیبر نوری دارد';
                    break;
                case 3:
                    $str = 'همسایه ها سرویس فیبر نوری دارند';
                    break;
                case 4:
                    $str = 'همسایه ها سرویس فیبر نوری ندارند ';
                    break;
                case 5:
                    $str = 'نمیدانم';
                    break;
            }
            $request->request_base = $str;
            $str = '';
            switch ($request->request_karshenasi) {
                case 0:
                    $str = 'خیر';
                    break;
                case 1:
                    $str = 'بله';
                    break;
            }
            $request->request_karshenasi = $str;
        }
        return $requests;
    }
}