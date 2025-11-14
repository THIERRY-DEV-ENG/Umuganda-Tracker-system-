<?php
$host = "sql108.infinityfree.com"; 
$user = "if0_40417092";
$pass = "Zitigate52030";
$dbname = "if0_40417092_umuganda";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
