<?php
require_once __DIR__ . "/product_media.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $mediaModel = new ProductMedia($db);

    $id = $_POST['product_media_id'] ?? null;
    $data = $_POST;

    if ($id) {
        $mediaModel->load($id);
        $data['updated_date'] = date('Y-m-d H:i:s');
    } else {
        $data['created_date'] = date('Y-m-d H:i:s');
    }

    $mediaModel->setData($data);
    if ($mediaModel->save()) {
        header("Location: list.php?success=1");
    } else {
        echo "Error saving media.";
    }
} else {
    header("Location: list.php");
}
exit();
?>
