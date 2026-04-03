<?php 

require_once __DIR__ . "/customer_group.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();

    $group = new CustomerGroup($db);

    if($group->delete($_POST['group_ids'])){
        header("Location:list.php");
    }else {
        header("Location:list.php?error=no_selection");
    }
}else {
    header("Location:list.php");
}
exit();