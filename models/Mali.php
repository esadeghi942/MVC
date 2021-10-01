<?php
namespace Models;

use Carbon\Carbon;
use Systems\Auth;

class Mali extends BaseModel
{
    const primary = 'mali_id',
        table = 'malis',
        fillable = [''],
        timecreate = 'mali_create';
    public $payment;
    public function __construct($id = 0)
    {
        $QB=QB::getInstance();
        $payment=$QB->table('admin')->get()->first();
        $this->payment=$payment->payment_amount;
        parent::__construct($id);
    }

    public function setPayment($amount){
        $this->payment=$amount;
        $QB=QB::getInstance();
        $QB->update('admin',['payment_amount'=>$this->payment])->exec();
    }

    public static function defineAttributeValue(MareiCollection $malis)
    {
        foreach ($malis as $mali) {
            $str = '';
            $class='success';
            switch ($mali->mali_status) {
                case 0:
                    $str = 'ناموفق';
                    $class='danger';
                    break;
                case 1:
                    $str = 'موفق';
                    $class='success';
                    break;
            }
            $mali->mali_status = $str;
            $mali->status_class = $class;
            $str = '';
            $link='';
            switch ($mali->mali_model) {
                case 'requests':
                    $str = 'کارشناسی حضوری';
                    $link='adminRequest?id=';
                    break;
                case 'bugs':
                    $str = 'خرابی';
                    $link='adminBug?id=';
                    break;
            }
            $mali->mali_model=$str;
            $mali->link=$link;
        }
        return $malis;
    }


    public static function custom_input($input)
    {
        $id = Auth::id();
        $res = [];
        $date = Carbon::now()->toDateTimeString();
        foreach (self::fillable as $record)
            $res[$record] = $input[$record];
        $res['user_id'] = $id;
        $res['mali_phone'] = Auth::user()['user_phone'];
        $res[self::timecreate] = $date;
        return $res;
    }

    public function find_referece($reference_code){
        $QB=QB::getInstance();
        return $QB->table(Mali::table)->where('mali_reference_code',$reference_code)->get()->first();
    }
}