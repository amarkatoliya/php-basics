<?php
require_once __DIR__ . "/customer.php";

$db = new Database();

$query = "SELECT c.*, cg.group_name 
          FROM customer c 
          LEFT JOIN customer_group cg ON c.customer_group_id = cg.customer_group_id 
          ORDER BY c.customer_id DESC";
$customers = $db->fetchAll($query);

require_once __DIR__ . "/../header.php";
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Customer List</h3>
    <a href="form.php" class="btn btn-primary">New</a>
</div>

<form action="delete.php" method="POST" id="customerForm">
    <div class="mb-2">
        <button type="submit" class="btn btn-danger btn-sm">Delete Selected</button>
    </div>
    <table class="table table-bordered table-striped shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th width="50" class="text-center"><input type="checkbox" id="selectAll"></th>
                <th>ID</th>
                <th>Group</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($customers): foreach ($customers as $c): ?>
            <tr>
                <td class="text-center"><input type="checkbox" name="customer_ids[]" value="<?= $c['customer_id'] ?>"></td>
                <td><?= $c['customer_id'] ?></td>
                <td><?= htmlspecialchars($c['group_name'] ?? 'No Group') ?></td>
                <td><?= htmlspecialchars($c['first_name'] . ' ' . $c['last_name']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['phone'] ?? '-') ?></td>
                <td><?= $c['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                <td><a href="form.php?id=<?= $c['customer_id'] ?>" class="btn btn-sm btn-info text-white">Edit</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="8" class="text-center py-4 text-muted">No customers found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</form>

<script>
    document.getElementById('selectAll').onclick = e => 
        document.querySelectorAll('input[name="customer_ids[]"]').forEach(cb => cb.checked = e.target.checked);
    
    document.getElementById('customerForm').onsubmit = () => {
        if (!document.querySelector('input[name="customer_ids[]"]:checked')) {
            alert('Please select at least one item.');
            return false;
        }
        return confirm('Are you sure?');
    };
</script>

</div></body></html>
