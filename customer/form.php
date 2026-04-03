<?php
require_once __DIR__ . "/customer.php";

$db = new Database();
$customer = new Customer($db);

if (isset($_GET['id'])) {
    $customer->load($_GET['id']);
}

$groups = $db->fetchAll("SELECT * FROM customer_group ORDER BY group_name ASC");

require_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= $customer->value('customer_id') ? 'Edit' : 'New' ?> Customer</h3>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</div>

<div class="card shadow-sm p-4 bg-white border-0 rounded-3">
    <form action="save.php" method="POST">
        <?php if ($customer->value('customer_id')): ?>
            <input type="hidden" name="customer_id" value="<?= $customer->value('customer_id') ?>">
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($customer->value('first_name') ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($customer->value('last_name') ?? '') ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($customer->value('email') ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($customer->value('phone') ?? '') ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Customer Group</label>
            <select name="customer_group_id" class="form-select">
                <option value="">No Group</option>
                <?php if ($groups): foreach ($groups as $g): ?>
                <option value="<?= $g['customer_group_id'] ?>" <?= $customer->value('customer_group_id') == $g['customer_group_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($g['group_name']) ?>
                </option>
                <?php endforeach; endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1" <?= $customer->value('status') == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= $customer->value('status') == 0 ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Save</button>
            <a href="list.php" class="btn btn-outline-secondary px-4 ms-2">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
