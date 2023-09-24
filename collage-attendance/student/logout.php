<?php
session_start();
unset($_SESSION["student_username"]);
unset($_SESSION["student_name"]);
header('location:student_login.php');
?>