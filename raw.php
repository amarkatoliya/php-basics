<?php
include "database.php";

class Row
{
    protected $db;
    protected $data = [];
    protected $tableName;
    protected $primaryKey;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function load($value, $column = null)
    {
        $column = $column ?: $this->primaryKey;
        $query = "SELECT * FROM `{$this->tableName}` WHERE `$column` = '" . addslashes($value) . "'";
        $result = $this->db->fetchRow($query);
        if ($result) {
            $this->data = $result;
            return $this;
        }
        return false;
    }

    public function insert()
    {
        $cols = implode(", ", array_keys($this->data));
        $vals = "'" . implode("', '", array_map('addslashes', array_values($this->data))) . "'";
        $query = "INSERT INTO `{$this->tableName}` ($cols) VALUES ($vals)";
        $id = $this->db->insert($query);
        if ($id) {
            $this->data[$this->primaryKey] = $id;
            return $this;
        }
        return false;
    }

    public function update()
    {
        $sets = [];
        foreach ($this->data as $k => $v) {
            if ($k !== $this->primaryKey) $sets[] = "`$k` = '" . addslashes($v) . "'";
        }
        $query = "UPDATE `{$this->tableName}` SET " . implode(', ', $sets);
        $query .= " WHERE `{$this->primaryKey}` = " . (int)$this->data[$this->primaryKey];
        return $this->db->update($query) ? $this : false;
    }

    public function delete($ids)
    {
        $ids = (array)$ids;
        if (empty($ids)) return false;

        $idsStr = implode(',', array_map('intval', $ids));
        $query = "DELETE FROM `{$this->tableName}` WHERE `{$this->primaryKey}` IN ($idsStr)";
        return $this->db->delete($query);
    }

    public function save()
    {
        if (isset($this->data[$this->primaryKey]) && !empty($this->data[$this->primaryKey])) {
            return $this->update();
        } else {
            return $this->insert();
        }
    }

    public function value($key, $value = null)
    {
        if ($value !== null) {
            $this->data[$key] = $value;
            return $this;
        }
        return $this->data[$key] ?? null;
    }

    public function setData($data) { $this->data = $data; return $this; }
    public function getData() { return $this->data; }
}
?>
