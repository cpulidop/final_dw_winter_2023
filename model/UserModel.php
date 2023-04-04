<?php
require_once(__DIR__ . "/../controller/DBConnection.php");

class UserModel extends DBConnection {
    private $id;
    private $name;
    private $last_name;
    private $username;
    private $password;
    private $created;
    private $modified;

    /**
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param mixed $modified
     */
    public function setModified($modified): void
    {
        $this->modified = $modified;
    }


    public function find($params = []) {
        $query = "Select * from users WHERE 1 = 1";

        foreach ($params as $key => $val) {
            $query .= " AND " . $key . " = ?";
        }

        return $this->query($query, $params);
    }

    public function new($params) {
        $query = "INSERT INTO users (`name`, last_name, username, password, created) VALUES (?, ?, ?, ?, ?)";
        $params['password'] = hash("sha256", $params['password']);

        return $this->excecute($query, $params);
    }

    public function edit($params, $conditions) {
        $query = "UPDATE users SET ";
        $countP = 0;
        $countC = 0;

        foreach ($params as $key => $val) {
            $cm = $countP++ > 0 ? ", " : "";
            $query .= $cm . $key . " = ?";
        }

        foreach ($conditions as $key => $val) {
            $cm = $countC++ > 0 ? " AND " : " WHERE ";
            $query .= $cm . $key . " = ?";
        }

        $params['password'] = hash("sha256", $params['password']);

        return $this->excecute($query, $params, $conditions);
    }




}
