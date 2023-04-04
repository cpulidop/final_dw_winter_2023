<?php
require_once("Controller.php");
include(__DIR__ . "/../model/UserModel.php");

class MainController extends Controller {

    function __construct() {
    }

    static function init($page = "/") {
        //If session has already started redirects to home
        if(session_id() != '' || isset($_SESSION) || session_status() !== PHP_SESSION_NONE) {
            header("Location: view/home.php");
            exit();
        } else if ($page == "/") {
            header("Location: view/login.php");
        }
    }

    public function login($post) {
        $data = self::sanitizePost($post);
        $userModel = new UserModel();
        $result = $userModel->find(["username" => @$data["username"]]);

        if (!empty($result)) {

            if (hash_equals(hash("sha256", @$data["password"]), $result[0]["password"])) {
                return [
                    "id" => $result[0]["id"],
                    "name" => $result[0]["name"],
                    "last_name" => $result[0]["last_name"],
                    "username" => $result[0]["username"],
                ];
            }
        }

        return [];
    }

    public function logout() {
        session_start();

        session_destroy();

        header("Location: login.php");
    }

    public function reset($post) {
        $error = true;
        $message = "Invalid Data";
        $data = self::sanitizePost($post);

        if (@$data["password"] != @$data["confirmPassword"]) {
            $message = "Sorry, you entered 2 different passwords.";
        } else {
            $userModel = new UserModel();
            $validate = $userModel->find(["username" => @$data["username"]]);

            if (!empty($validate)) {
                $result = $userModel->edit(
                    [
                        "username" => @$data["username"],
                        "password" => @$data["password"],
                        "modified" => date("Y-m-d H:i:s"),
                    ],
                    [
                        "id" => $validate[0]["id"]
                    ]
                );
                if ($result >= 0) {
                    $error = false;
                    $message = "Your password has been modified.";
                } else {
                    $message = "Error modifying password.";
                }
            } else {
                $message = "Username not found.";
            }

        }

        return [
            "error" => $error,
            "message" => $message,
        ];
    }

    public function register($post) {
        $error = true;
        $message = "Invalid Data";
        $data = self::sanitizePost($post);
        if (@$data["password"] != @$data["confirmPassword"]) {
            $message = "Sorry, you entered 2 different passwords.";
        } else {
            $userModel = new UserModel();
            $result = $userModel->find([
                "username" => @$data["username"]
            ]);

            if (empty($result)) {
                $insert = $userModel->new([
                    "name" => @$data["name"],
                    "lastName" => @$data["lastName"],
                    "username" => @$data["username"],
                    "password" => @$data["password"],
                    "created" => date("Y-m-d H:i:s"),
                ]);

                if ($insert > 0) {
                    $error = false;
                    $message = "User registered.";
                } else {
                    $message = "Invalid data.";
                }
            } else {
                $message = "Username already registered.";
            }
        }

        return [
            "error" => $error,
            "message" => $message,
        ];
    }



}