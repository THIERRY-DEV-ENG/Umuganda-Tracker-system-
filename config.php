<?php
$conn = new mysqli("localhost", "root", "", "umuganda");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>