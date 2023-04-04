<?php
require_once(__DIR__ . "/../controller/DBConnection.php");

class SessionModel extends DBConnection
{
    private $id;
    private $user_id;
    private $result;
    private $lives_used;
    private $created;

    /**
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function find($params = []) {
        $query = "Select sessions.*, users.username from sessions INNER JOIN users ON users.id = sessions.user_id WHERE 1 = 1";

        foreach ($params as $key => $val) {
            $query .= " AND " . $key . " = ?";
        }

        return $this->query($query, $params);
    }

    public function new($params) {
        $query = "INSERT INTO sessions (user_id, result, lives_used, created) VALUES (?, ?, ?, ?)";

        return $this->excecute($query, $params);
    }


}