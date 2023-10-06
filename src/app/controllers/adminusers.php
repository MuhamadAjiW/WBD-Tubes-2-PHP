<?php

namespace app\controllers;

use app\core\Controller;

class AdminUsers extends Controller{
    public function index(){
        $usermodel = $this->model('UserModel');
        $userdata = $usermodel->fetchAllUsers();

        $this->view('AdminUsers', ['userdata' => $userdata]);
    }

    public function delete() {
        if (isset($_POST['user_id'])) {
            $usermodel = $this->model('UserModel');

            $rows = $usermodel->deleteUserByID($_POST['user_id']);

            if ($rows) {
                http_response_code(200);
                echo json_encode(array("message" => "Delete user success"));

            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Delete user failed"));
            }
        }
        else {
            http_response_code(400);
            echo json_encode(array("message" => "Bad request."));
        }
    }
}

?>