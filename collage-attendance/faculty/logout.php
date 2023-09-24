<?php
session_start();
unset($_SESSION["faculty_username"]);
unset($_SESSION["faculty_name"]);
header('location:faculty_login.php');
?>