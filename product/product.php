<?php

require_once __DIR__ . "/../raw.php";

class Product extends Row
{
    protected $tableName = 'product';
    protected $primaryKey = 'product_id';
}   