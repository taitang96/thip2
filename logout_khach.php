<?php
session_start();
if(isset($_SESSION["khachhang"]))
{
unset($_SESSION['khachhang']);
header("Location: index.php");
}
?>