<?php

require_once __DIR__ . '/customer_group.php';
require_once __DIR__ . '/../header.php';

$db = new Database();

$groups = $db->fetchAll("SELECT * FROM customer_group ORDER BY customer_group_id DESC");

?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Customer Group List</h3>
    <a href="form.php" class="btn btn-primary">New</a>
</div>

<form action="delete.php" method="POST" id="groupForm">
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
            <?php if ($groups): foreach ($groups as $g): ?>
            <tr>
                <td class="text-center"><input type="checkbox" name="group_ids[]" value="<?= $g['customer_group_id'] ?>"></td>
                <td><?= $g['customer_group_id'] ?></td>
                <td><?= htmlspecialchars($g['group_name']) ?></td>
                <td><?= htmlspecialchars($g['description']) ?></td>
                <td><?= $g['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                <td><a href="form.php?id=<?= $g['customer_group_id'] ?>" class="btn btn-sm btn-info text-white">Edit</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="6" class="text-center py-4">No groups found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</form>

<script>
    document.getElementById('selectAll').onclick = e => 
        document.querySelectorAll('input[name="group_ids[]"]').forEach(cb => cb.checked = e.target.checked);
    
    document.getElementById('groupForm').onsubmit = () => {
        if (!document.querySelector('input[name="group_ids[]"]:checked')) {
            alert('Please select at least one item.');
            return false;
        }
        return confirm('Are you sure?');
    };
</script>

</div>
</body>
</html>
