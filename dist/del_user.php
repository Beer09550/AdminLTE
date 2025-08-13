<?php
$username = $_GET["username"];
require '../connect.php';
$spl = "DELETE FROM users WHERE username = '$username'";
$result = $con->query($spl);
if (!$result)   {
    echo "<script> alert ('Can not delete')</script>";
} else{
    echo "<script> window.location.href='index.php?page=user_list'</script>";
}
?>