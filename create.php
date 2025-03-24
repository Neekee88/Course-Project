<?php
include '../db.php';

$user_name = $user_email = $user_pass = $user_add = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = trim($_POST['user_name']);
    $user_email = trim($_POST['user_email']);
    $user_pass = trim($_POST['user_pass']);
    $user_add = trim($_POST['user_add']);

    if (empty($user_name)) $errors[] = "Name is required.";
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (strlen($user_pass) < 6) $errors[] = "Password must be at least 6 characters.";
    if (empty($user_add)) $errors[] = "Address is required.";

    if (empty($errors)) {
        $hashed_pass = password_hash($user_pass, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_pass, user_add, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $user_name, $user_email, $hashed_pass, $user_add);
        $stmt->execute();

        header("Location: read.php");
        exit;
    }
}
?>

<h2>Create User</h2>
<form method="POST">
    Name: <input type="text" name="user_name" value="<?= htmlspecialchars($user_name) ?>"><br>
    Email: <input type="email" name="user_email" value="<?= htmlspecialchars($user_email) ?>"><br>
    Password: <input type="password" name="user_pass"><br>
    Address: <textarea name="user_add"><?= htmlspecialchars($user_add) ?></textarea><br>
    <input type="submit" value="Register">
</form>

<?php foreach ($errors as $error): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endforeach; ?>