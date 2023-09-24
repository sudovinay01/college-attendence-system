<?php
$db = new mysqli('localhost','root','', "vinaykumar");
if (!$db)
{
   	die("Connection failed: " . mysqli_connect_error());
}
?>