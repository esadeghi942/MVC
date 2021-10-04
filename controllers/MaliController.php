<?php

namespace Controllers;

use Carbon\Carbon;
use Models\Bug;
use Models\Mali;
use Models\Request;
use Models\User;
use Systems\Auth;
use Systems\PackPay;
use Systems\SMS;
use Systems\Url;
use Systems\View;
use Models\QB;
use Systems\Validation;

class MaliController
{
    public function request()
    {
        $QB=QB::getInstance();
        if(Url::get('request_id') != null){
            $id=Url::get('request_id');
            $model=Request::table;
            $amount=(new Mali())->payment;
            $url='../userRequestIndex';
        }
        //bug payment
        else{
            $model=Bug::table;
            $id=Url::get('bug_id');
            $url='../userBugIndex';
            $amount=$QB->table(Bug::table)->where('bug_id',$id)->get()->first()->pay_amount;
        }
        $GateWay = new PackPay();
        $token = $GateWay->refresh_token();
        if (!$token)
            return View::redirect($url, ['danger' => 'خطایی در اتصال به درگاه بانکی رخ داده لطفا دوباره نسبت به پرداخت اقدام کنید.']);

        $data = [
            'access_token' => $token,
            'amount' => $amount, //مبلغ به ریال
            'callback_url' => 'http://tehranftth.ir/panel/verify_payment/', //آدرس بازگشت به سایت شما بعد از اتمام عملیات پرداخت
            'payer_id' => Auth::user()['user_phone'],//فیلد اختیاری شماره تلفن پرداخت کننده
            'payer_name' => Auth::user()['user_name'],//فیلد اختیاری نام پرداخت کننده
            'verify_on_request' => true,
        ];
        $send_to_bank_result = $GateWay->send_to_bank($data);
        var_dump($send_to_bank_result);
        return ;
        if ($send_to_bank_result['status'] == "0") {
            $reference_code = $send_to_bank_result['reference_code'];
            $QB->insert(Mali::table,['user_id'=>Auth::id(),'mali_model'=>$model,'model_id'=>$id,'mali_amount'=>$amount,'mali_reference_code'=>$reference_code,'mali_create'=>Carbon::now()->toDateTimeString()]);
            $redirect_url = "https://dashboard.packpay.ir/bank/purchase/send/?RefId=${reference_code}";
            View::redirect($redirect_url);
        }
        else {
            return View::redirect($url, ['danger' => 'دراتصال به درگاه پرداخت مشکلی پیش امده لطفا بعدا دوباره تلاش کنید.']);
            //echo $send_to_bank_result['message'];
        }
    }

    public function verify(){
        $GateWay=new PackPay();
        $token = $GateWay->refresh_token();
        $reference_code = $_GET['reference_code']; //کد رفرنس دریافتی از طریق درخواست get
        $data = [
            'access_token' => $token,
            'reference_code' => $reference_code,
        ];
        $verify_result = $GateWay->verify($data);
        $mali=new Mali();
        $mali=$mali->find_referece($reference_code);
        $model=$mali->mali_model;
        $model_id=$mali->model_id;
        if($model=='requests'){
           $url='../userRequestIndex';
        }
        //bug payment
        else {
           $url='../userBugIndex';
        }
        if ($verify_result['status']=="0"){
            $QB=QB::getInstance();
            $QB->update(Mali::table,['mali_status'=>1])->where('mali_reference_code',$reference_code);
            if($model=='requests'){
                $QB->update(Request::table, ['request_payment_status'=>1])->where(Request::primary, $model_id)->exec();
                return View::redirect($url, ['success' => 'عملیات پرداخت با موفقیت انجام شد.']);
                //echo $verify_result['message'];
            }
            //bug payment
            else {
                $QB->update(Bug::table, ['bug_payment_status' => 1])->where(Bug::primary,$model_id)->exec();
                return View::redirect($url, ['success' => 'عملیات پرداخت با موفقیت انجام شد.']);
                //echo $verify_result['message'];
            }
        }else{
            return View::redirect($url, ['danger' => 'دراتصال به درگاه پرداخت مشکلی پیش امده لطفا بعدا دوباره تلاش کنید.']);
            //echo $verify_result['message'];
        }
    }

    public function adminSetPayment(){
        $amount=$_POST['payment_amount'];
        (new Validation())::Validate($_POST,['payment_amount' => 'required|numeric']);
        (new Mali())->setPayment($amount);
        return View::redirect('../admin',['success'=>'هزینه کارشناسی با موفقیت تغییر کرد']);
    }

    public function restSms(){
        $amount=SMS::GetCredit();
        return View::make('admin/restSms',['amount'=>$amount]);
    }

    public function adminPayment(){
        $amount=(new Mali())->payment;
        return View::make('admin/payment',['payment_amount'=>$amount]);
    }

    function adminIndex(){
        $QB=QB::getInstance();
        $mali=$QB->table(Mali::table)->naturalJoin(User::table)->get();
        $mali=Mali::defineAttributeValue($mali);
        return View::make('admin/mali/index',['malis'=>$mali]);
    }

    function DeleteMali(){
        $id=$_POST['id'];
        $mali=new Mali($id);
        $res=$mali->delete();
        if($res)
            Url::response('success','تراکنش با موفقیت حذف شد.');
        else
            Url::response('danger','مشکلی در حذف  به وجود امده.');
    }
}