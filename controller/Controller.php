<?php

require_once(__DIR__ . "/../config/config.php");

class Controller {

    static function sanitizePost($post) {
        foreach ($post as $key => $data) {
            $post[$key] = trim(filter_var($_POST[$key], FILTER_SANITIZE_STRING));
        }

        return $post;
    }
}