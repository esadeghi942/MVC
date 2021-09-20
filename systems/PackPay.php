<?php

namespace Systems;

class PackPay
{
    private const client_id="sSpxZfxGSPWNF79itzGz";
    private const secret_id="Y6xNl5TQtx9RIyUU8osWjzwJpNurVY";
    private const refresh_token="069833d6-84bb-42cc-bbf2-e0a60592d731";

    private function request($method)
    {

        try {
            $ch = curl_init("https://dashboard.packpay.ir/" . $method);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, []);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, self::client_id . ":" .self::secret_id );
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                )
            );
            $result = curl_exec($ch);
            return json_decode($result, true);
        } catch (Exception $ex) {
            return false;
        }
    }

   public function refresh_token()
    {
        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => self::refresh_token
        ];
        $method = 'oauth/token?' . http_build_query($data);
        $result = self::request($method);
        if (!array_key_exists('access_token',$result)) return false;
        return $result['access_token'];
    }

    public function send_to_bank($request){
        $method = 'developers/bank/api/v2/purchase?' . http_build_query($request);
        return self::request($method);
    }

    public function verify($request){
        $method = 'developers/bank/api/v2/purchase/verify?' . http_build_query($request);
        return self::request($method);
    }
}