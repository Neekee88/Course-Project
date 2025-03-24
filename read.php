<?php
include '../db.php';
$result = $conn->query("SELECT * FROM users");
?>

<h2>User List</h2>
<a href="create.php">➕ Add New User</a>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Address</th><th>Registered</th><th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['user_id'] ?></td>
        <td><?= htmlspecialchars($row['user_name']) ?></td>
        <td><?= htmlspecialchars($row['user_email']) ?></td>
        <td><?= htmlspecialchars($row['user_add']) ?></td>
        <td><?= $row['created_at'] ?></td>
        <td>
            <a href="update.php?id=<?= $row['user_id'] ?>">✏️ Edit</a> |
            <a href="delete.php?id=<?= $row['user_id'] ?>" onclick="return confirm('Delete this user?')">🗑️ Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>