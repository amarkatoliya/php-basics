<?php

require_once __DIR__ . "/database.php";

class Table
{
    protected $_tableName = null;
    protected $_primaryKey = null;
    protected $_data = [];
    protected $adapter = null;

    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->_primaryKey = $primaryKey;
    }

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function getAdapter()
    {
        if ($this->adapter === null) {
            $this->adapter = (new Database('localhost', 'root', 'xyz', ''))->connect();
        }
        return $this->adapter;
    }

    public function __set($name, $val)
    {
        $this->_data[$name] = $val;
    }

    public function __get($name)
    {
        return $this->_data[$name] ?? null;
    }

    public function insert()
{
    if (!$this->_tableName) {
        throw new Exception("Table name not set");
    }

    $columns = implode(", ", array_map(fn($col) => "`$col`", array_keys($this->_data)));

    $values = array_map(function($value) {
        return "'" . $this->getAdapter()->real_escape_string($value) . "'";
    }, array_values($this->_data));

    $values = implode(", ", $values);

    $query = "INSERT INTO {$this->_tableName} ($columns) VALUES ($values)";

    return $this->getAdapter()->insert($query);
}
}


$obj = new Table();

// $obj->setPrimaryKey();

// echo "$_primaryKey";