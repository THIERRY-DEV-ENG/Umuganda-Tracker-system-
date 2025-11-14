<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'config.php';
session_start();
if (!isset($_SESSION['user_id']) || !isset($_POST['gps_coords']) || !isset($_POST['photo_data'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$gps_coords = $_POST['gps_coords'];
$photo_data = explode('|', $_POST['photo_data']);

$target_dir = "uploads/";
if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);

$zone = $conn->query("SELECT zone FROM users WHERE user_id = $user_id")->fetch_assoc()['zone'];


foreach ($photo_data as $base64_image) {
    if ($base64_image) {
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_image));
        $file_name = uniqid() . '.jpg';
        $target_file = $target_dir . $file_name;
        if (file_put_contents($target_file, $data)) {
            $stmt = $conn->prepare("INSERT INTO photos (user_id, photo_path, gps_coordinates, timestamp) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iss", $user_id, $target_file, $gps_coords);
            $stmt->execute();
        }
    }
}


$photo_count = $conn->query("SELECT COUNT(*) as count FROM photos WHERE user_id = $user_id")->fetch_assoc()['count'];
if ($photo_count >= 2) {

    $_SESSION['validated'] = true;
}

header("Location: dashboard.php");
exit();
?>