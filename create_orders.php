<?php
include '../db.php';

$order_id = $flow_id = $order_items_quant = $order_items_price = "";
$errors = [];

$orders = $conn->query("SELECT orders_id FROM orders");
$flowers = $conn->query("SELECT flow_id, flow_name, flow_price FROM flowers");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $flow_id = $_POST['flow_id'];
    $order_items_quant = $_POST['order_items_quant'];

    // Get flower price from DB
    $price_stmt = $conn->prepare("SELECT flow_price FROM flowers WHERE flow_id = ?");
    $price_stmt->bind_param("i", $flow_id);
    $price_stmt->execute();
    $price_result = $price_stmt->get_result();
    $price_row = $price_result->fetch_assoc();
    $order_items_price = $price_row['flow_price'];

    if (!is_numeric($order_items_quant) || $order_items_quant <= 0) {
        $errors[] = "Quantity must be a positive number.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, flow_id, order_items_quant, order_items_price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $order_id, $flow_id, $order_items_quant, $order_items_price);
        $stmt->execute();

        header("Location: read.php");
        exit;
    }
}
?>

<h2>Add Item to Order</h2>
<form method="POST">
    Order ID:
    <select name="order_id">
        <?php while ($row = $orders->fetch_assoc()): ?>
            <option value="<?= $row['orders_id'] ?>"><?= $row['orders_id'] ?></option>
        <?php endwhile; ?>
    </select><br>

    Flower:
    <select name="flow_id">
        <?php while ($row = $flowers->fetch_assoc()): ?>
            <option value="<?= $row['flow_id'] ?>">
                <?= htmlspecialchars($row['flow_name']) ?> ($<?= number_format($row['flow_price'], 2) ?>)
            </option>
        <?php endwhile; ?>
    </select><br>

    Quantity: <input type="number" name="order_items_quant"><br>
    <input type="submit" value="Add Item">
</form>

<?php foreach ($errors as $error): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endforeach; ?>