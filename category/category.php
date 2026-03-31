<?php

include_once __DIR__ . "/../raw.php";

class Category extends Row {
    protected $tableName = 'category';
    protected $primaryKey = 'category_id';
}