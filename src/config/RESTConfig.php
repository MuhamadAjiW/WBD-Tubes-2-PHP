<?php

namespace config;

class RESTConfig{
    public static function getURL() {
        return getenv('REST_URL');
    }
    public static function getToken() {
        return getenv('REST_TOKEN');
    }
}

?>