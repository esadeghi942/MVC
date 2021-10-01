<?php

namespace Systems;
use Melipayamak\MelipayamakApi;

class SMS
{
const username = '09127266505', password = '7220';
    static function send($to,$text){
        try{
            $api = new MelipayamakApi(self::username,self::password);
            $sms = $api->sms();
           // $to = '09123456789';
            $from = 'tehranftth';
           // $text = 'تست وب سرویس ملی پیامک';
            $response = $sms->send($to,$from,$text);
            $json = json_decode($response);
            //echo $json->Value;
            return true;
        }catch(\Exception $e){
            return false;
            echo $e->getMessage();
        }
    }
}