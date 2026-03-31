<?php

class Database
{
    private $server;
    private $username;
    private $dbname;
    private $password;
    private $conn;

    public function __construct($server, $username, $dbname, $password)
    {
        $this->server = $server;
        $this->username = $username;
        $this->dbname = $dbname;
        $this->password = $password;
    }

    public function connect()
    {
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: ") . $this->conn->connect_error;
        }
        return $this;
    }

    // crud oprations
    public function insert($query)
    {
        $result = $this->conn->query($query);

        if ($result) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function update($query)
    {
        $result = $this->conn->query($query);

        return $result ? true : false;
    }

    public function delete($query)
    {
        $result = $this->conn->query($query);

        return $result ? true : false;
    }

    public function fetchRow($query)
    {
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function fetchAll($query)
    {
        $result = $this->conn->query($query);

        if ($result && $result->num_rows > 0) {
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }
        return false;
    }

    public function query($query)
    {
        return $this->conn->query($query);
    }

}


?>