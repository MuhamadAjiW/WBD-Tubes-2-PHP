<?php

namespace config;

class SOAPConfig{
    public static function getURL() {
        return getenv('SOAP_URL');
    }
    public static function getToken() {
        return getenv('SOAP_TOKEN');
    }
    public static function getService(){
        return getenv("SOAP_SERVICE");
    }
}

?>