<?php
include '../db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$user_name = $user['user_name'];
$user_email = $user['user_email'];
$user_add = $user['user_add'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = trim($_POST['user_name']);
    $user_email = trim($_POST['user_email']);
    $user_add = trim($_POST['user_add']);

    if (!empty($user_name) && filter_var($user_email, FILTER_VALIDATE_EMAIL) && !empty($user_add)) {
        $stmt = $conn->prepare("UPDATE users SET user_name=?, user_email=?, user_add=? WHERE user_id=?");
        $stmt->bind_param("sssi", $user_name, $user_email, $user_add, $id);
        $stmt->execute();
        header("Location: read.php");
        exit;
    } else {
        echo "<p style='color:red;'>Invalid input.</p>";
    }
}
?>

<h2>Edit User</h2>
<form method="POST">
    Name: <input type="text" name="user_name" value="<?= htmlspecialchars($user_name) ?>"><br>
    Email: <input type="email" name="user_email" value="<?= htmlspecialchars($user_email) ?>"><br>
    Address: <textarea name="user_add"><?= htmlspecialchars($user_add) ?></textarea><br>
    <input type="submit" value="Update">
</form>