<?php

namespace Systems;

class SMS
{
    private const username = '*************', password = '************';

    static function send($to, $text)
    {
        $sms_client = new \SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding' => 'UTF-8'));
        $parameters['username'] = self::username;
        $parameters['password'] = self::password;
        $parameters['to'] =$to;
        $parameters['text'] = $text;
        $parameters['isflash'] = true;
        return $sms_client->SendSimpleSMS2($parameters)->SendSimpleSMS2Result != 11;
    }

    static function GetCredit(){
        $sms_client = new \SoapClient('http://api.payamak-panel.com/post/Send.asmx?wsdl', array('encoding'=>'UTF-8'));
        $parameters['username'] = self::username;
        $parameters['password'] = self::password;
        return number_format($sms_client->GetCredit($parameters)->GetCreditResult);
    }
}
