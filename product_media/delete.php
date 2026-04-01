<?php
require_once __DIR__ . "/product_media.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database("localhost", "root", "xyz", "");
    $db->connect();

    $ids = isset($_POST['media_ids']) ? $_POST['media_ids'] : [];

    if (!empty($ids)) {
        $idsStr = implode(',', array_map('intval', $ids));
        $query = "DELETE FROM product_media WHERE product_media_id IN ($idsStr)";
        if ($db->delete($query)) {
            header("Location: list.php?deleted=1");
        } else {
            echo "Error: Delete failed.";
        }
    } else {
        header("Location: list.php?error=no_selection");
    }
} else {
    header("Location: list.php");
}
exit();
?>