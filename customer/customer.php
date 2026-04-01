<?php

require_once __DIR__ . '/../raw.php';

class customer extends Row
{
    protected $tableName = 'customer';
    protected $primaryKey = 'customer_id';
}