<?php
include_once __DIR__ . "/product.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    
    $productModel = new Product($db);
    
    if ($productModel->delete($_POST['product_ids'] ?? [])) {
        header("Location: list.php?deleted=1");
    } else {
        header("Location: list.php?error=no_selection");
    }
} else {
    header("Location: list.php");
}
exit();
?>