<?php 

include_once __DIR__ . "/../raw.php";

class CustomerGroup extends Row
{
    protected $tableName = 'customer_group';
    protected $primaryKey = 'customer_group_id';
}