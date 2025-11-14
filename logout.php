<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$photo_count = $conn->query("SELECT COUNT(*) as count FROM photos WHERE user_id = $user_id")->fetch_assoc()['count'];
?>
session_start();
session_destroy();
header("Location: index.php");
exit();
?>