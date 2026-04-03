<?php
require_once __DIR__ . "/product_media.php";

$db = new Database();
$media = new ProductMedia($db);

if (isset($_GET['id'])) {
    $media->load($_GET['id']);
}

$products = $db->fetchAll("SELECT product_id, name FROM product ORDER BY name ASC");

require_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= $media->value('product_media_id') ? 'Edit' : 'New' ?> Media</h3>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</div>

<div class="card shadow-sm p-4 bg-white border-0 rounded-3">
    <form action="save.php" method="POST">
        <?php if ($media->value('product_media_id')): ?>
            <input type="hidden" name="product_media_id" value="<?= $media->value('product_media_id') ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Product</label>
            <select name="product_id" class="form-select" required>
                <option value="">Select Product (Required)</option>
                <?php if ($products): foreach ($products as $p): ?>
                <option value="<?= $p['product_id'] ?>" <?= $media->value('product_id') == $p['product_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['name']) ?>
                </option>
                <?php endforeach; endif; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">File Path</label>
            <input type="text" name="file_path" class="form-control" value="<?= htmlspecialchars($media->value('file_path') ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alt Text</label>
            <input type="text" name="alt_text" class="form-control" value="<?= htmlspecialchars($media->value('alt_text') ?? '') ?>">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" step="0.01" name="sort_order" class="form-control" value="<?= $media->value('sort_order') ?? '0.00' ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Is Primary</label>
                <select name="is_primary" class="form-select">
                    <option value="0" <?= $media->value('is_primary') == 0 ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= $media->value('is_primary') == 1 ? 'selected' : '' ?>>Yes</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Save</button>
            <a href="list.php" class="btn btn-outline-secondary px-4 ms-2">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
