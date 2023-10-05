<?php

namespace app\controllers;

use app\core\Controller;

class EditUser extends Controller{
    public function index(){
        if (isset($_GET['user_id'])) {
            $usermodel = $this->model("UserModel");

            $userdata = $usermodel->fetchUserByID($_GET['user_id']);

            $this->view('EditUser', ['userdata' => $userdata]);
        }
    }

    public function edit() {
        if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['bio']) && isset($_POST['admin']) && isset($_POST['user_id'])) {
            $usermodel = $this->model("UserModel");

            $usernameexist = $usermodel->checkUsernameExists2($_POST['username']);

            if ($usernameexist['user_id'] != $_POST['user_id']) {
                http_response_code(409);
                echo json_encode(array("message" => "Username can't be the same"));
            } else {
                if (isset($_POST['password'])) {
                    $rows = $usermodel->updateUserData($_POST['user_id'], $_POST['name'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['bio'], $_POST['admin']);

                    if ($rows) {
                        http_response_code(200);
                        echo json_encode(array("message" => "Edit user success", "redirect" => "/admin/users"));
                    } else {
                        http_response_code(500);
                        echo json_encode(array("message" => "Edit user failed"));
                    }
                } else {
                    $rows = $usermodel->updateUserData2($_POST['user_id'], $_POST['name'], $_POST['username'], $_POST['email'], $_POST['bio'], $_POST['admin']);

                    if ($rows) {
                        http_response_code(200);
                        echo json_encode(array("message" => "Edit user success", "redirect" => "/admin/users"));
                    } else {
                        http_response_code(500);
                        echo json_encode(array("message" => "Edit user failed"));
                    }
                }
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Bad request."));
        }
    }
}

?>