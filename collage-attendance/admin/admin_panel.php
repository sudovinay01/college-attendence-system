<?php
session_start();
require("../db.php");
$error="";
if(!isset($_SESSION["admin_username"]) OR !isset($_SESSION["admin_name"]))
{
  header('location:admin_login.php');
}
if (isset($_POST["submit"]))
{
  $year=$_POST['year'];
  $branch=$_POST['branch'];
  $section=$_POST['section'];
  $from=$_POST['from'];
  $to=$_POST['to'];
  $table=$branch."-".$year."-".$section;
   $sql="SHOW Tables  LIKE  '".$table."'";
    $result=mysqli_query($db,$sql);
  if ($to<$from) 
  {
  $error=" <div class='alert alert-danger'>Please enter a valied date.</div>";
  }
  else if (mysqli_num_rows($result) <= 0) {
  	 $error=" <div class='alert alert-danger'>There is no data of give class .</div>";
  }
  else
  {
    $_SESSION['year']=$year;
    $_SESSION['branch']=$branch;
    $_SESSION['section']=$section;
    $_SESSION['from']=$from;
    $_SESSION['to']=$to;
    header('location:result.php');
  
  }

}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
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
    <style type="text/css">
      @media screen and (max-width: 500px) {
      .custom-control-inline{
        display: block;
      }
      }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top shadow">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="admin_panel.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_panel_faculty.php">Faculty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="admin_panel_students.php">Students</a>
      </li>
    
    </ul>
    <ul class="navbar-nav border border-danger">
      <li class="nav-item ">
        <span class="nav-link text-white text-center "><?php echo $_SESSION["admin_name"];?></span>
      </li>
       <li class="nav-item">
        <a class="nav-link btn btn-danger text-white " href="logout.php">Logout</a>
      </li>   
     </ul>
  </div>  
</nav>
<div style="margin-top: 70px;">
<div class="card shadow">
  <div class="card-body">
    <div class="jumbotron">
      <h1>Attendence data</h1>
    </div>
     <?php
      if (isset($_SESSION["msg"]))
    {
    echo "<div class='alert alert-info mt-2'>".$_SESSION["msg"]."</div>";
    unset($_SESSION['msg']);
    }
    if($error!="")
    {
      echo $error;
      $error="";
    }
  ?>
    <form action="" method="POST">
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
      <tr><td style="width:30%;">Year</td>
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
      <tr><td>From<input type="date" name="from"></td><td>To<input type="date" name="to"></td></tr>
    </table>
  </div>

    <input type="submit" name="submit" class="btn btn-primary" value="submit">
  </form>
  </div>
</div>
</div>
</body>
</html>