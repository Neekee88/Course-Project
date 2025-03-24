<?php
include '../db.php';

$query = "
SELECT oi.order_items_id, o.orders_id, f.flow_name, oi.order_items_quant, oi.order_items_price
FROM order_items oi
JOIN orders o ON oi.order_id = o.orders_id
JOIN flowers f ON oi.flow_id = f.flow_id
";
$result = $conn->query($query);
?>

<h2>Order Items</h2>
<a href="create.php">➕ Add Order Item</a>
<table border="1" cellpadding="8">
    <tr>
        <th>Item ID</th><th>Order ID</th><th>Flower</th><th>Quantity</th><th>Price</th><th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['order_items_id'] ?></td>
        <td><?= $row['orders_id'] ?></td>
        <td><?= htmlspecialchars($row['flow_name']) ?></td>
        <td><?= $row['order_items_quant'] ?></td>
        <td>$<?= number_format($row['order_items_price'], 2) ?></td>
        <td>
            <a href="update.php?id=<?= $row['order_items_id'] ?>">✏️ Edit</a> |
            <a href="delete.php?id=<?= $row['order_items_id'] ?>" onclick="return confirm('Remove item?')">🗑️ Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>