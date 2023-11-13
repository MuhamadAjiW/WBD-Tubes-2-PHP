<?php

namespace app\util;

use app\core\Request;
use config\AppConfig;
use config\RESTConfig;

Class RESTUtil{
    public function sendRequest($endpoint, $method, $data){
        $url = RESTConfig::getURL() . $endpoint;
        
        // TODO: Delete later
        echo $url . "<br>";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . AppConfig::getToken(),
        ]);

        if($method){
            switch ($method) {
                case Request::GET_METHOD:
                    break;
                case Request::POST_METHOD:
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    break;
                case Request::PUT_METHOD:
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    break;
                case Request::DELETE_METHOD:
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;
                case Request::PATCH_METHOD:
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    break;
                default:
                    break;
            }
        }

        $response = curl_exec($ch);

        if (curl_errno($ch)){
            echo "Curl error: " . curl_error($ch);
        }

        curl_close($ch);
        if ($response !== false) {
            $responseData = json_decode($response, true);
            
            // TODO: Delete later
            echo "<br>Result:<br>";
            var_dump($responseData);

            return $responseData;
        } else {
            echo 'Failed to retrieve data from the API.';
        }
    }

    public function testRequest(){
        $data = [
            "email" => "dummy1@example.com",
            "username" => "dummy_user1",
            "password" => "dummy_password",
            "name" => "Dummy Name",
            "bio" => "This is a dummy bio"
        ];

        $data = json_encode($data);
        $this->sendRequest("/api/authors", Request::POST_METHOD, $data);
    }
}

?>