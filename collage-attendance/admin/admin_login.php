<?php
session_start();
require("../db.php");
if(isset($_SESSION["admin_username"]) AND isset($_SESSION["admin_name"]))
{
  header('location:admin_panel.php');
}
$error="";
$count_error=0;
if (isset($_POST['admin_submit']))
{
  $username=$_POST['username'];
  $password=$_POST['password'];
  if(!preg_match('/^[\w]+$/', $username) OR !preg_match('/^[\w]+$/', $password))
  {
    $count_error=1;
    $error="<div class='alert alert-danger'>Invalid username/password</div>";
  }
  if ($count_error==0) 
  {
    $sql="SELECT `username`, `password`,`name` FROM `admin` WHERE username='$username' LIMIT 1";
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
    if ($row>0)
    { 
      if(password_verify($password, $row["password"]))
      {
        $_SESSION["admin_name"]=$row["name"];
        $_SESSION["admin_username"]=$row["username"];
        header('location:admin_panel.php');
      }
      else
      {
        $error="<div class='alert alert-danger'>Invalid username/password</div>";
      }
    } 
    else
    {
      $error="<div class='alert alert-danger'>Invalid username/password</div>";
    }
  }

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    if ( window.history.replaceState )
    {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
</head>
<body>
<div class="jumbotron bg-light text-dark d-flex justify-content-center">
  <h1>Admin Login</h1>
</div>
<div class="container card">
  <a href="../"><button type="submit" class="btn btn-primary" name="faculty_submit">HOME</button></a>
<form action="" method="POST" class="card-body">
  <?php
    if($error!="")
    {
      echo $error;
      $error="";
    }
  ?>
  <div class="form-group">
    <label for="username">Username:</label>
    <input  class="form-control" type="text" placeholder="Enter username" name="username" autocomplete="off" required>
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input  class="form-control" type="password" placeholder="Enter password" name="password" autocomplete="off" required>
  </div>
  <button type="submit" class="btn btn-primary" name="admin_submit">Submit</button>
</form>
</div>
<footer style="text-align: center;" class="bg-light m-2 p-2">
  <p>Developers content</p>
  <p>Name - m vinay kumar(16RJ1A05C8)</p>
  for more details<a href="http://vinaykumar.epizy.com"> click here</a>
</footer>
</body>
</html>