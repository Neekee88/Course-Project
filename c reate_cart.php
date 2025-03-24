<?php
include '../db.php';

$user_id = 1; // ← You can dynamically pull from session/login
$cart_quant = 1;
$errors = [];

// Get flowers for dropdown
$flowers = $conn->query("SELECT flow_id, flow_name FROM flowers");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flow_id = $_POST['flow_id'];
    $cart_quant = $_POST['cart_quant'];

    if (!is_numeric($cart_quant) || $cart_quant <= 0) $errors[] = "Quantity must be positive.";

    // Check if already in cart
    $check = $conn->prepare("SELECT * FROM cart WHERE user_id=? AND flow_id=?");
    $check->bind_param("ii", $user_id, $flow_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "This flower is already in the cart.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO cart (user_id, flow_id, cart_quant, added_at) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iii", $user_id, $flow_id, $cart_quant);
        $stmt->execute();
        header("Location: read.php");
        exit;
    }
}
?>

<h2>Add to Cart</h2>
<form method="POST">
    Flower:
    <select name="flow_id">
        <?php while ($row = $flowers->fetch_assoc()): ?>
            <option value="<?= $row['flow_id'] ?>"><?= htmlspecialchars($row['flow_name']) ?></option>
        <?php endwhile; ?>
    </select><br>

    Quantity: <input type="number" name="cart_quant" value="<?= htmlspecialchars($cart_quant) ?>"><br>
    <input type="submit" value="Add to Cart">
</form>

<?php foreach ($errors as $error): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endforeach; ?>
