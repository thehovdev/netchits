<?php

function is_youtube($address) {
        // паттер
        $search = 'youtube';
        // поиск
        $find = strpos($address, $search);
        // результат

        if($find === false) {
            $result = "not";
            return $result;
        } else {
            $result = "yes";
            return $result;
        }
    }

function getcode_youtube($address) {

        if(strpos($address, "&")) {
            $videocode = stristr($email, '&', true);
            return $videocode;
        }

        $code = strstr($address, 'v=');
        $videocode = str_replace("v=", "", $code);
        return $videocode;
    }
