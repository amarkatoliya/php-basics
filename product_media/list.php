<?php
require_once __DIR__ . "/product_media.php";

$db = new Database();

$query = "SELECT pm.*, p.name as product_name 
          FROM product_media pm 
          LEFT JOIN product p ON pm.product_id = p.product_id 
          ORDER BY pm.product_media_id DESC";
$media = $db->fetchAll($query);

require_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Product Media List</h3>
    <a href="form.php" class="btn btn-primary">New</a>
</div>

<form action="delete.php" method="POST" id="mediaForm">
    <div class="mb-2">
        <button type="submit" class="btn btn-danger btn-sm">Delete Selected</button>
    </div>
    <table class="table table-bordered table-striped shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th width="50" class="text-center"><input type="checkbox" id="selectAll"></th>
                <th>ID</th>
                <th>Product</th>
                <th>Image Path</th>
                <th>Alt Text</th>
                <th>Sort</th>
                <th>Primary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($media): foreach ($media as $m): ?>
            <tr>
                <td class="text-center"><input type="checkbox" name="media_ids[]" value="<?= $m['product_media_id'] ?>"></td>
                <td><?= $m['product_media_id'] ?></td>
                <td><?= htmlspecialchars($m['product_name'] ?? 'No Product') ?></td>
                <td class="text-truncate" style="max-width: 200px;"><?= htmlspecialchars($m['file_path']) ?></td>
                <td><?= htmlspecialchars($m['alt_text'] ?? '-') ?></td>
                <td><?= $m['sort_order'] ?? '0' ?></td>
                <td><?= ($m['is_primary'] ?? 0) == 1 ? 'Yes' : 'No' ?></td>
                <td><a href="form.php?id=<?= $m['product_media_id'] ?>" class="btn btn-sm btn-info text-white">Edit</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="8" class="text-center py-4">No media found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</form>

<script>
    document.getElementById('selectAll').onclick = e => 
        document.querySelectorAll('input[name="media_ids[]"]').forEach(cb => cb.checked = e.target.checked);
    
    document.getElementById('mediaForm').onsubmit = () => {
        if (!document.querySelector('input[name="media_ids[]"]:checked')) {
            alert('Please select at least one item.');
            return false;
        }
        return confirm('Are you sure?');
    };
</script>

</div></body></html>
