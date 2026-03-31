<?php
include_once __DIR__ . "/product.php";
include_once __DIR__ . "/../header.php";

$db = new Database("localhost", "root", "xyz", "");
$db->connect();
$product = new Product($db);

if (isset($_GET['id'])) {
    $product->load($_GET['id']);
}

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3><?= $product->value('product_id') ? 'Edit' : 'New' ?> Product</h3>
    <a href="list.php" class="btn btn-secondary">Cancel</a>
</div>

<div class="card shadow-sm p-4 bg-white border-0 rounded-3">
    <form action="save.php" method="POST">
        <?php if ($product->value('product_id')): ?>
            <input type="hidden" name="product_id" value="<?= $product->value('product_id') ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control"
                value="<?= htmlspecialchars($product->value('name') ?? '') ?>" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control"
                    value="<?= $product->value('quantity') ?? 0 ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" class="form-control"
                    value="<?= $product->value('price') ?? '0.00' ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"
                rows="4"><?= htmlspecialchars($product->value('description') ?? '') ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="1" <?= $product->value('status') == 1 ? 'selected' : '' ?>>Enabled</option>
                <option value="2" <?= $product->value('status') == 2 ? 'selected' : '' ?>>Disabled</option>
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