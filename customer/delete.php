<?php
include_once __DIR__ . "/customer.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    
    $ids = isset($_POST['customer_ids']) ? $_POST['customer_ids'] : [];
    
    if (!empty($ids)) {
        $idsStr = implode(',', array_map('intval', $ids));
        $query = "DELETE FROM customer WHERE customer_id IN ($idsStr)";
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
