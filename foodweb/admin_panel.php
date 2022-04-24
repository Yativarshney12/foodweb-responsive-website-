<?php
session_start();
require("include/connection.php");
include"header.php";
include"sidebar.php";
if(!isset($_SESSION['AdminLoginId'])){
header('location:admin_login.php');
}
?>

