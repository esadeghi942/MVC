<?php

namespace Models;

use Carbon\Carbon;
use Systems\Auth;

class Bug extends BaseModel
{
    const table = 'bugs',
        primary = 'bug_id',
        userfillable = ['bug_virtual_number','bug_pan','bug_last', 'bug_description'],
        adminfillable = ['bug_answer'];
    public function files()
    {
        $qb = QB::getInstance();
        $bug = $qb->table(File::table)->where('file_model',self::table)->
        where('model_id',$this->id)->get();
        return $bug;
    }

    public static function custom_input($input, $edit = false)
    {
        $res = [];
        $id=Auth::id();
        $date = Carbon::now()->toDateTimeString();
        $str = $edit ? 'bug_update' : 'bug_create';
        foreach (self::userfillable as $record) {
            $res[$record] = $input[$record];
            $res[User::primary] = $id;
            $res[$str] = $date;
        }
        return $res;
    }

    public static function defineAttributeValue(MareiCollection $bugs)
    {
        foreach ($bugs as $bug) {
            $str = '';
            switch ($bug->bug_status) {
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
            $bug->bug_status = $str;
        }
        return $bugs;
    }
}