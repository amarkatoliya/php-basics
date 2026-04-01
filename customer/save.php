<?php
require_once __DIR__ . "/customer.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database("localhost", "root", "xyz", "");
    $db->connect();
    $customerModel = new Customer($db);

    $id = $_POST['customer_id'] ?? null;
    $data = $_POST;

    // Handle NULL foreign key correctly
    if (empty($data['customer_group_id'])) {
        $data['customer_group_id'] = null;
    }

    if ($id) {
        $customerModel->load($id);
        $data['updated_date'] = date('Y-m-d H:i:s');
    } else {
        $data['created_date'] = date('Y-m-d H:i:s');
    }

    $customerModel->setData($data);
    if ($customerModel->save()) {
        header("Location: list.php?success=1");
    } else {
        echo "Error: Could not save customer.";
    }
} else {
    header("Location: list.php");
}
exit();
?>
