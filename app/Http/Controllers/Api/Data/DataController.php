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

    public function encryptOpenssl($openData) {

        $i = 11;
        $key = openssl_random_pseudo_bytes($i);

        $algorithm = "aes-256-gcm";

        $ivlen = openssl_cipher_iv_length($algorithm);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encryptedData = openssl_encrypt($openData, $algorithm, $key,
                                        $options=0, $iv, $tag);

        return $encryptedData;
    }
}
