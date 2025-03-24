<?php
include '../db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM order_items WHERE order_items_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

$order_items_quant = $item['order_items_quant'];
$order_items_price = $item['order_items_price'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_items_quant = $_POST['order_items_quant'];
    $order_items_price = $_POST['order_items_price'];

    if (is_numeric($order_items_quant) && is_numeric($order_items_price)) {
        $stmt = $conn->prepare("UPDATE order_items SET order_items_quant = ?, order_items_price = ? WHERE order_items_id = ?");
        $stmt->bind_param("idi", $order_items_quant, $order_items_price, $id);
        $stmt->execute();
        header("Location: read.php");
        exit;
    } else {
        echo "<p style='color:red;'>Invalid input.</p>";
    }
}
?>

<h2>Edit Order Item</h2>
<form method="POST">
    Quantity: <input type="number" name="order_items_quant" value="<?= htmlspecialchars($order_items_quant) ?>"><br>
    Price: <input type="text" name="order_items_price" value="<?= htmlspecialchars($order_items_price) ?>"><br>
    <input type="submit" value="Update">
</form>