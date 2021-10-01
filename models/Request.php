<?php

namespace Models;

use Carbon\Carbon;
use Systems\Auth;
use Systems\View;

class Request extends BaseModel
{
    const table = 'requests',
        primary = 'request_id',
        userfillable = ['request_address', 'request_buildstatus', 'request_owner', 'request_count_unit', 'request_count_request','request_karbary', 'request_build_request', 'request_fix_number', 'request_base', 'request_karshenasi'],
        adminfillable = ['request_answer'],
        timecreate = 'request_create';

    /* public function find()
     {
         $qb = QB::getInstance();
         $request = $qb->table(self::table)->where(self::primary, $this->id)->get();
         return $request[0];
     }*/

    public function files()
    {
        $Qb=QB::getInstance();
        $files = $Qb->table(File::table)->where('file_model', self::table)->
        where('model_id', $this->id)->get();
        return $files;
    }

    public function delete()
    {
        $files = self::files();
        foreach ($files as $file) {
            $f = new File($file->file_id);
            $f->delete();
        }
        $answers=self::answers();
        foreach ($answers as $item){
            $a=new Bnswer($item->answer_id);
            $a->delete();
        }
        return parent::delete();
    }

    public static function custom_input($input, $edit = false)
    {
        $res = [];
        $id = Auth::id();
        $date = Carbon::now()->toDateTimeString();
        $str = $edit ? 'request_update' : 'request_create';
        foreach (self::userfillable as $record)
            $res[$record] = $input[$record];
        $res[User::primary] = $id;
        $res[$str] = $date;
        return $res;
    }

    public static function defineAttributeValue(MareiCollection $requests)
    {
        foreach ($requests as $request) {
            $str = '';
            $class='success';
            switch ($request->request_status) {
                case 0:
                    $str = 'مشاهده نشده';
                    $class='danger';
                    break;
                case 1:
                    $str = 'در حال بررسی';
                    $class='warning';
                    break;
                case 2:
                    $str = 'اعلام نتیجه';
                    $class='success';
                    break;
            }
            $color='';

            if($request->request_karshenasi && $request->request_status==2) {
                $color='rgb(200, 255, 200)';
            }
            if($request->request_karshenasi && $request->request_status==1) {
                $color='rgb(255,255,200)';
            }
            if($request->request_karshenasi && $request->request_status==0) {
                $color='rgb(255,180,180)';
            }
            $request->color=$color;
            $request->request_status = $str;
            $request->status_class = $class;
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
            switch ($request->request_karbary) {
                case 0:
                    $str = 'مسکونی';
                    break;
                case 1:
                    $str = 'اداری';
                    break;
            }
            $request->request_karbary = $str;
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
            $karsh_class='';
            switch ($request->request_karshenasi) {
                case 0:
                    $str = 'خیر';
                    $karsh_class='danger';
                    break;
                case 1:
                    $str = 'بله';
                    $karsh_class='success';
                    break;
            }
            $request->request_karshenasi = $str;
            $request->karsh_class = $karsh_class;
            $str='';
            if(!$request->request_karshenasi) {
                $payment_class = 'warning';
                $str = 'فاقد هزینه';
            }
            elseif($request->request_karshenasi && $request->request_payment_status){
                $str = 'پرداخت شده';
                $payment_class='success';
            }
            elseif($request->request_karshenasi && !$request->request_payment_status){
                $str = 'پرداخت نشده';
                $payment_class='danger';
            }
            $request->request_payment_status=$str;
            $request->request_payment_class=$payment_class;
        }
        return $requests;
    }

    public static function defineAttributeValueItem(MareiObj $request)
    {
        $res = [];
        foreach ($request as $k => $i) {
            $str = '';
            $val = $i;
            switch ($k) {
                case 'request_status':
                    $str = 'وضعیت درخواست';
                    switch ($i){
                        case 0:
                            $val = 'مشاهده نشده';
                            break;
                        case 1:
                            $val = 'در حال بررسی';
                            break;
                        case 2:
                            $val = 'اعلام نتیجه';
                            break;
                    }
                    break;
                case 'request_answer':
                    $str = 'پاسخ کارشناس';
                    if(empty($i))
                        $val='هنوز پاسخی ارسال نشده .';
                    break;
                case 'request_address':
                    $str = 'آدرس دقیق برای کارشناسی';
                    break;
                case 'request_buildstatus':
                    $str = 'وضعیت ساختمان';
                    switch ($i){
                        case 0:
                            $val = ' درحال ساخت';
                            break;
                        case 1:
                            $val = 'در حال بازسازی ';
                            break;
                        case 2:
                            $val = 'نوساز ';
                            break;
                        case 3:
                            $val = ' عمر تا 10 سال';
                            break;
                        case 4:
                            $val = 'بیشتر از 10 سال ';
                            break;
                    }
                    break;
                case 'request_owner':
                    $str = 'وضعیت مالکیت';
                    switch ($i) {
                        case 0:
                            $val = 'مالک';
                            break;
                        case 1:
                            $val = 'اجاره ای';
                            break;
                    }
                    break;
                case 'request_karbary':
                    $str = 'وضعیت کاربری';
                    switch ($i) {
                        case 0:
                            $val = 'مسکونی';
                            break;
                        case 1:
                            $val = 'اداری';
                            break;
                    }
                    break;
                case 'request_count_unit':
                    $str = 'تعداد واحد ';
                    break;
                case 'request_karshenasi':
                    $str = 'درخواست کارشناسی در محل';
                    switch ($i) {
                        case 0:
                            $val = 'خیر';
                            break;
                        case 1:
                            $val = 'بله';
                            break;
                    }
                    break;
                case 'request_base':
                    $str = 'بستر فیبر نوری در ساختمان';
                    switch ($i) {
                        case 0:
                            $val = 'در ساختمان وجود دارد';
                            break;
                        case 1:
                            $val = 'در واحد پریز فیبر نوری وجود دارد';
                            break;
                        case 2:
                            $val = 'در کوچه باکس فیبر نوری دارد';
                            break;
                        case 3:
                            $val = 'همسایه ها سرویس فیبر نوری دارند';
                            break;
                        case 4:
                            $val = 'همسایه ها سرویس فیبر نوری ندارند ';
                            break;
                        case 5:
                            $val = 'نمیدانم';
                            break;
                    }
                    break;
                case 'request_count_request':
                    $str = 'تعداد درخواست';
                    break;
                case 'request_fix_number':
                    $str = 'تلفن ثابت';
                    break;
                case 'request_create':
                    $str = 'تاریخ ثبت درخواست';
                    $val=verta($i);
                    break;
            }
            $res[$str] = $val;
        }
        return $res;
    }
}