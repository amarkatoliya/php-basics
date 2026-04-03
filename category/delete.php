<?php 

include_once __DIR__ . "/category.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db = new Database();

    $categoryModel = new Category($db);

    if($categoryModel->delete($_POST['category_ids'] ?? [])) {
        header("Location: list.php?deleted=1");
    }else {
        header("Location: list.php?error=no_selection");
    }
}else {
    header("Location: list.php");
}
exit();
