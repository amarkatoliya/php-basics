<?php
include_once __DIR__ . "/product.php";


$db = new Database("localhost", "root", "xyz", "");
$db->connect();
$products = $db->fetchAll("SELECT * FROM product ORDER BY product_id DESC");

include_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Product List</h3>
    <div>
        <a href="form.php" class="btn btn-primary">New</a>
    </div>
</div>

<form action="delete.php" method="POST" id="productForm">
    <div class="mb-2">
        <button type="submit" class="btn btn-danger btn-sm" id="deleteBtn">Delete Selected</button>
    </div>
    <table class="table table-bordered table-striped table-hover bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th width="50 text-center"><input type="checkbox" id="selectAll"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Description</th>
                <th>Status</th>
                <th width="150 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($products):
                foreach ($products as $p): ?>
                    <tr>
                        <td class="text-center"><input type="checkbox" name="product_ids[]" value="<?= $p['product_id'] ?>">
                        </td>
                        <td><?= $p['product_id'] ?></td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= $p['quantity'] ?></td>
                        <td>$<?= number_format($p['price'], 2) ?></td>
                        <td class="text-truncate" style="max-width: 150px;"><?= htmlspecialchars($p['description']) ?></td>
                        <td><span
                                class="badge <?= $p['status'] == 1 ? 'bg-success' : 'bg-warning' ?>"><?= $p['status'] == 1 ? 'Enabled' : 'Disabled' ?></span>
                        </td>
                        <td class="text-center">
                            <a href="form.php?id=<?= $p['product_id'] ?>" class="btn btn-sm btn-info text-white">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</form>

<script>
    document.getElementById('selectAll').onclick = (e) =>
        document.querySelectorAll('input[name="product_ids[]"]').forEach(cb => cb.checked = e.target.checked);

    document.getElementById('productForm').onsubmit = (e) => {
        const checked = document.querySelectorAll('input[name="product_ids[]"]:checked').length;
        if (!checked) {
            alert('Please select at least one item to delete.');
            return false;
        }
        return confirm('Are you sure you want to delete selected products?');
    };
</script>

</div>
</body>

</html>