<?php
include '../db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT cart_quant FROM cart WHERE cart_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$cart = $result->fetch_assoc();

$cart_quant = $cart['cart_quant'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_quant = $_POST['cart_quant'];

    if (is_numeric($cart_quant) && $cart_quant > 0) {
        $stmt = $conn->prepare("UPDATE cart SET cart_quant = ? WHERE cart_id = ?");
        $stmt->bind_param("ii", $cart_quant, $id);
        $stmt->execute();
        header("Location: read.php");
        exit;
    } else {
        echo "<p style='color:red;'>Invalid quantity.</p>";
    }
}
?>

<h2>Update Quantity</h2>
<form method="POST">
    Quantity: <input type="number" name="cart_quant" value="<?= htmlspecialchars($cart_quant) ?>"><br>
    <input type="submit" value="Update">
</form>