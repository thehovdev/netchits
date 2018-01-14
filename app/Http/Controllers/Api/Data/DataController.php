<?php

namespace App\Http\Controllers\Api\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends Controller
{

    public function cookieNull($cookieName) {
        if (isset($_COOKIE[$cookieName])) {
            unset($_COOKIE[$cookieName]);
            setcookie($cookieName, '', time() - 3600, '/'); // empty value and old timestamp
        }
    }

    // потом добавить decryptOpenssl
    public function encryptOpenssl($openData) {

        $i = 11;
        $key = openssl_random_pseudo_bytes($i);

        $algorithm = 'aes-256-gcm';

        $ivlen = openssl_cipher_iv_length($algorithm);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encryptedData = openssl_encrypt($openData, $algorithm, $key,
                                        $options=0, $iv, $tag);
        return $encryptedData;
    }


// netchits events for youtube

    public static function is_youtube($address) {
        // паттер
        $search = 'youtube';
        // поиск
        $find = strpos($address, $search);
        // результат

        if($find === false) {
            $result = "yes";
            return $result;
        } else {
            $result = "not";
            return $result;
        }
    }

    public static function getcode_youtube($address) {

        if(strpos($address, "&")) {
            $videocode = stristr($email, '&', true);
            return $videocode;
        }

        $code = strstr($address, 'v=');
        $videocode = str_replace("v=", "", $code);
        return $videocode;
    }

    public function test() {
        $result = "test";
        return $result;

    }


}
