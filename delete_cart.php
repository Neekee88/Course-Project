<?php
include '../db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: read.php");
exit;