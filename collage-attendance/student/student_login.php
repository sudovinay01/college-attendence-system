<?php
session_start();
require("../db.php");
if(isset($_SESSION["student_username"]) AND isset($_SESSION["student_name"]))
{
  header('location:student_panel.php');
}
$error="";
$count_error=0;
if (isset($_POST['student_submit']))
{
  $username=$_POST['username'];
  $year=$_POST['year'];
  $password=$_POST['password'];
  $branch=$_POST['branch'];
  $section=$_POST['section'];
  $_SESSION['syear']=$_POST['year'];
  $_SESSION['sbranch']=$_POST['branch'];
  $_SESSION['ssection']=$_POST['section'];
  if(!preg_match('/^[\w]+$/', $username) OR !preg_match('/1|2|3|4/', $year)OR !preg_match('/a|b|c|d/', $section)OR !preg_match('/cse|civil|ece|has/', $branch))
  {
    $count_error=1;
    $error="<div class='alert alert-danger'>Invalid Entry</div>";
  }
  if ($count_error==0) 
  {
    $sql="SELECT `no`,`id`,`username`, `password`,`name` FROM `".$branch."-".$year."-".$section."` WHERE `username`='$username' AND `status`='on' LIMIT 1";
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
 
    if ($row>0)
    { 
       if(password_verify($password, $row["password"]))
      {
        $_SESSION["student_name"]=$row["name"];
        $_SESSION["student_username"]=$row["username"];
        $_SESSION["sno"]=$row["no"];
        header('location:student_panel.php');
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
	<title>student Login</title>
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
  <h1>Student Login</h1>
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
    <div class="table-responsive rounded">
      <table class="table table-bordered table-striped table-hover ">
      <tr><td style="width:10%;">Branch</td>
      <td><div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="cse" name="branch" value="cse"  required="required">
          <label class="custom-control-label" for="cse">CSE</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
           <input type="radio" class="custom-control-input" id="civil" name="branch" value="civil">
            <label class="custom-control-label" for="civil">CIVIL</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="ece" name="branch" value="ece">
        <label class="custom-control-label" for="ece">ECE</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="has" name="branch" value="has">
        <label class="custom-control-label" for="has">H&S</label>
      </div></td>
      </tr>
      <tr><td style="width:10%;">Year</td>
      <td><div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="1" name="year" value="1"  required="required">
          <label class="custom-control-label" for="1">I</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
           <input type="radio" class="custom-control-input" id="2" name="year" value="2">
            <label class="custom-control-label" for="2">II</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="3" name="year" value="3">
        <label class="custom-control-label" for="3">III</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="4" name="year" value="4">
        <label class="custom-control-label" for="4">IV</label>
      </div></td>
      </tr>
      <tr><td style="width:10%;">Section</td>
      <td><div class="custom-control custom-radio custom-control-inline">
          <input type="radio" class="custom-control-input" id="a" name="section" value="a"  required="required">
          <label class="custom-control-label" for="a">A</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
           <input type="radio" class="custom-control-input" id="b" name="section" value="b">
            <label class="custom-control-label" for="b">B</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="c" name="section" value="c">
        <label class="custom-control-label" for="c">C</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" class="custom-control-input" id="d" name="section" value="d">
        <label class="custom-control-label" for="d">D</label>
      </div></td>
      </tr>
    </table>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input  class="form-control" type="text" placeholder="Enter username" name="username" autocomplete="off" required>
  </div>
   <div class="form-group">
    <label for="username">Password</label>
    <input  class="form-control" type="text" placeholder="Enter password" name="password" autocomplete="off" required>
  </div>
  <button type="submit" class="btn btn-primary" name="student_submit">Submit</button>
</form>
</div>
<footer style="text-align: center;" class="bg-light m-2 p-2">
  <p>Developers content</p>
  <p>Name - m vinay kumar(16RJ1A05C8)</p>
  for more details<a href="http://vinaykumar.epizy.com"> click here</a>
</footer>
</body>
</html>