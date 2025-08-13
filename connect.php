<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "it42";

$con = mysqli_connect($host, $user, $pass, $dbname);
if (!$con) {
    die("การเชื่อมต่อผิดพลาด: " . mysqli_connect_error());
}
