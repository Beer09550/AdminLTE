<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "it42";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die("การเชื่อมต่อผิดพลาด: " . mysqli_connect_error());
}
