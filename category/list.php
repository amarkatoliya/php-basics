<?php
include_once __DIR__ . "/category.php";


$db = new Database("localhost", "root", "xyz", "");
$db->connect();
$categories = $db->fetchAll("SELECT * FROM category ORDER BY category_id DESC");

include_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>category List</h3>
    <div>
        <a href="form.php" class="btn btn-primary">New</a>
    </div>
</div>

<form action="delete.php" method="POST" id="categoryForm">
    <div class="mb-2">
        <button type="submit" class="btn btn-danger btn-sm">Delete Selected</button>
    </div>
    <table class="table table-bordered table-striped shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th width="50" class="text-center"><input type="checkbox" id="selectAll"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($categories):
                foreach ($categories as $c): ?>
                    <tr>
                        <td class="text-center"><input type="checkbox" name="category_ids[]" value="<?= $c['category_id'] ?>">
                        </td>
                        <td><?= $c['category_id'] ?></td>
                        <td><?= htmlspecialchars($c['name']) ?></td>
                        <td><?= htmlspecialchars($c['description']) ?></td>
                        <td><?= $c['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                        <td><a href="form.php?id=<?= $c['category_id'] ?>" class="btn btn-sm btn-info text-white">Edit</a></td>
                    </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="6" class="text-center">No categories found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</form>

<script>
    document.getElementById('selectAll').onclick = e =>
        document.querySelectorAll('input[name="category_ids[]"]').forEach(cb => cb.checked = e.target.checked);

    document.getElementById('categoryForm').onsubmit = () => {
        if (!document.querySelector('input[name="category_ids[]"]:checked')) {
            alert('Please select at least one item.');
            return false;
        }
        return confirm('Are you sure?');
    };
</script>

</div>
</body>

</html>