<?php
session_start();
unset($_SESSION["admin_username"]);
unset($_SESSION["admin_name"]);
header('location:admin_login.php');
?>