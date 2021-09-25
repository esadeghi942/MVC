<?php

namespace Models;

use Carbon\Carbon;
use Systems\Auth;

class Bug extends BaseModel
{
    const table = 'bugs',
        primary = 'bug_id',
        userfillable = ['bug_virtual_number', 'bug_pan', 'bug_last', 'bug_description'],
        adminfillable = ['bug_answer','bug_payment'],
        timecreate = 'bug_create';

    public function files()
    {
        $QB=QB::getInstance();
        $bug = $QB->table(File::table)->where('file_model', self::table)->
        where('model_id', $this->id)->get();
        return $bug;
    }

    public static function custom_input($input, $edit = false)
    {
        $res = [];
        $id = Auth::id();
        $date = Carbon::now()->toDateTimeString();
        $str = $edit ? 'bug_update' : 'bug_create';
        foreach (self::userfillable as $record) {
            $res[$record] = $input[$record];
            $res[User::primary] = $id;
            $res[$str] = $date;
        }
        return $res;
    }

    public function delete()
    {
        $files = self::files();
        foreach ($files as $file) {
            $f = new File($file->file_id);
            $f->delete();
        }
        return parent::delete();
    }

    public static function defineAttributeValue(MareiCollection $bugs)
    {
        foreach ($bugs as $bug) {
            $str = '';
            $class='';
            switch ($bug->bug_status) {
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
            $bug->bug_status = $str;
            $bug->status_class = $class;
        }
        return $bugs;
    }

    public static function defineAttributeItem(MareiObj $bug)
    {
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
        $str = '';
        switch ($bug->bug_pan) {
            case 0:
                $str = 'سبز روشن و ثابت';
                break;
            case 1:
                $str = 'سبز روشن و چشمک زن';
                break;
        }
        $bug->bug_pan = $str;
        $str = '';
        switch ($bug->bug_last) {
            case 0:
                $str = 'قرمز روشن و چشمک زن';
                break;
            case 1:
                $str = 'خاموش';
                break;
        }
        $bug->bug_create=verta($bug->bug_create);
        $bug->bug_last = $str;
        return $bug;
    }
}