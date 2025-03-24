<?php
include '../db.php';

$user_id = 1; // ← Replace with session logic
$query = "
SELECT cart.cart_id, flowers.flow_name, cart.cart_quant, cart.added_at
FROM cart
JOIN flowers ON cart.flow_id = flowers.flow_id
WHERE cart.user_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2>My Cart</h2>
<a href="add.php">➕ Add More Flowers</a>
<table border="1" cellpadding="8">
    <tr>
        <th>Flower</th><th>Quantity</th><th>Added At</th><th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['flow_name']) ?></td>
        <td><?= $row['cart_quant'] ?></td>
        <td><?= $row['added_at'] ?></td>
        <td>
            <a href="update.php?id=<?= $row['cart_id'] ?>">✏️ Update</a> |
            <a href="delete.php?id=<?= $row['cart_id'] ?>" onclick="return confirm('Remove from cart?')">🗑️ Remove</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>