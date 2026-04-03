<?php
include_once __DIR__ . "/category.php";

$db = new Database();
$category = new Category($db);

if (isset($_GET['id'])) {
    $category->load($_GET['id']);
}

include_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= $category->value('category_id') ? 'Edit' : 'New' ?> Category</h3>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</div>

<div class="card shadow-sm p-4 bg-white border-0 rounded-3">
    <form action="save.php" method="POST">
        <?php if ($category->value('category_id')): ?>
            <input type="hidden" name="category_id" value="<?= $category->value('category_id') ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control"
                value="<?= htmlspecialchars($category->value('name') ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"
                rows="4"><?= htmlspecialchars($category->value('description') ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1" <?= $category->value('status') == 1 ? 'selected' : '' ?>>Enabled</option>
                <option value="0" <?= $category->value('status') == 0 ? 'selected' : '' ?>>Disabled</option>
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