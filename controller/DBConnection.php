<?php

class DBConnection {

    private $connectionString;
    public $errors;

    public function __construct()
    {
        $this->connectionString = $this->connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

        if (!$this->connectionString) {
            header("Location: error.php");
        }
    }

    private function connect($hostname, $username, $password, $dbname) {
        $con = mysqli_connect($hostname, $username, $password, $dbname);
        if (mysqli_connect_error()) {
            $this->errors = mysqli_connect_error();

            return false;
        } else {

            return $con;
        }
    }

    public function query($sqlCommand, $params) {
        $this->commands[] = $sqlCommand;
        $args_ref = [];
        $types = "";

        foreach ($params as $key => $val) {
            $types .= $this->gettype($params[$key]);
            $args_ref[] = $val;
        }

        $stmt = $this->connectionString->prepare($sqlCommand);
        if (count($params) > 0) {
            $stmt->bind_param($types, ...$args_ref);
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }

        $this->errors = "Data selection from the Table failed!<br/>" . $this->connectionString->error;
        return false;
    }

    public function excecute($sqlCommand, $params, $conditions = []) {
        $args_ref = [];
        $types = "";

        foreach ($params as $key => $val) {
            $types .= $this->gettype($params[$key]);
            $args_ref[] = $val;
        }

        foreach ($conditions as $key => $val) {
            $types .= $this->gettype($conditions[$key]);
            $args_ref[] = $val;
        }

        $stmt = $this->connectionString->prepare($sqlCommand);
        $stmt->bind_param($types, ...$args_ref);

        if ($stmt->execute()) {

            return $this->connectionString->insert_id;
        }

        return -1;
    }



    private function getType($var) {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

}