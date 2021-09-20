<?php
namespace Models;

use Systems\PackPay;
use Systems\Url;
use Systems\View;

class Mali
{
    public function request()
    {
        $GateWay = new PackPay();
        $token = $GateWay->refresh_token();
        if (!$token)
            return View::redirect('', ['danger' => 'در اتصال به درگاه پرداخت مشکلی پیش امده لطفا بعدا دوباره تلاش کنید.'], true);
        /*
         * ارسال به بانک
         */
        $data = [
            'access_token' => $token,
            'amount' => 50000, //مبلغ به ریال
            'callback_url' => Url::baseURL() . '/verify/', //آدرس بازگشت به سایت شما بعد از اتمام عملیات پرداخت
            'payer_id' => '09101111111',//فیلد اختیاری شماره تلفن پرداخت کننده
            'payer_name' => 'محمد محمدی',//فیلد اختیاری نام پرداخت کننده
            'verify_on_request' => true
        ];
        $send_to_bank_result = $GateWay->send_to_bank($data);
        if ($send_to_bank_result['status'] == "0") {
            $reference_code = $send_to_bank_result['reference_code'];
            //کاربر را به آدرس زیر هدایت کنید
            //redirect user to this url
            $redirect_url = "https://dashboard.packpay.ir/bank/purchase/send/?RefId=${reference_code}";
            header("location:$redirect_url");
        } else {
            return View::redirect('', ['danger' => 'دراتصال به درگاه پرداخت مشکلی پیش امده لطفا بعدا دوباره تلاش کنید.'], true);
            //خطا رخ داده و این خطا را به صلاح دید خود هندل کنید
            //echo $send_to_bank_result['message'];
            //return;
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
        if ($verify_result['status']=="0"){
            echo $verify_result['message'];
            //در اینجا عملیات پردات موفقیت آمیز بوده و میتوانید پردازش مربوطه را انجام دهید
        }else{
            //خطا رخ داده و این خطا را به صلاح دید خود هندل کنید
            //یکی از اتفاقات رایج انصراف کاربر از بانک است
            echo $verify_result['message'];
        }
    }
}