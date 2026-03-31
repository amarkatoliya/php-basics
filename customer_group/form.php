<?php

require_once __DIR__ . '/customer_group.php';
require_once __DIR__ . '/../header.php';

$db = new Database("localhost","root","xyz","");
$db->connect();

$group = new CustomerGroup($db);

if(isset($_GET['id'])){
    $group->load($_GET['id']);
}

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= $group->value('customer_group_id') ? 'Edit' : 'New' ?> Customer Group</h3>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</div>


<div class="card shadow-sm p-4 bg-white border-0 rounded-3">
    <form action="save.php" method="POST">
        <?php if ($group->value('customer_group_id')): ?>
            <input type="hidden" name="customer_group_id" value="<?= $group->value('customer_group_id') ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Group Name</label>
            <input type="text" name="group_name" class="form-control"
                value="<?= htmlspecialchars($group->value('group_name') ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"
                rows="4"><?= htmlspecialchars($group->value('description') ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1" <?= $group->value('status') == 1 ? 'selected' : '' ?>>Enabled</option>
                <option value="0" <?= $group->value('status') == 0 ? 'selected' : '' ?>>Disabled</option>
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