<?php

namespace config;

class RESTConfig{
    public static function getURL() {
        return getenv('REST_URL');
    }
    public static function getToken() {
        return getenv('REST_TOKEN');
    }

    // Ini karena jalannya di docker jadi perlu yang versi localhost
    public static function getURLsecondary() {
        return getenv('REST_URL_SECONDARY');
    }
}

?>