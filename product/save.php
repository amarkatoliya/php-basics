<?php
include_once __DIR__ . "/product.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database("localhost", "root", "xyz", "");
    $db->connect();
    $product = new Product($db);

    $id = $_POST['product_id'] ?? null;
    $data = $_POST;

    if ($id) {
        $product->load($id);
        $data['updated_date'] = date('Y-m-d H:i:s');
    } else {
        $data['created_date'] = date('Y-m-d H:i:s');
    }

    $product->setData($data);
    if ($product->save()) {
        header("Location: list.php?success=1");
    } else {
        echo "Error saving product.";
    }
} else {
    header("Location: list.php");
}
exit();
?>