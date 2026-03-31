<?php

include_once __DIR__ . "/customer_group.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $db = new Database("localhost","root","xyz","");
    $db->connect();

    $group = new CustomerGroup($db);

    $id = $_POST['customer_group_id']  ?? null;
    $data = $_POST;

    if($id) {
        $group->load($id);
        $data['updated_date'] = date('Y-m-d H:m:s');
    }else {
        $data['created_date'] = date('Y-m-d H:m:s');
    }

    $group->setData($data);
    if($group->save()) {
        header("Location:list.php?success=1");
    }else {
        echo "Error saving customer group";
    }

}else {
    header("Location:list.php");
}
exit();