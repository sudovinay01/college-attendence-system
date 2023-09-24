<?php
session_start();
require("../db.php");
if(!isset($_SESSION["faculty_username"]) OR !isset($_SESSION["faculty_name"]))
{
  header('location:faculty_login.php');
}
if (isset($_POST["submit"]))
{
  $year=$_POST['year'];
  $branch=$_POST['branch'];
  $section=$_POST['section'];
  $sql="SHOW TABLES LIKE '".$branch."-".$year."-".$section."'";
  if(!mysqli_num_rows(mysqli_query($db,$sql)))
  {
    $sql="CREATE TABLE `".$branch."-".$year."-".$_POST['section']."` ( `no` INT NOT NULL AUTO_INCREMENT , `id` VARCHAR(100) NOT NULL , `name` VARCHAR(100) NOT NULL , `username` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `status` varchar(100) NOT NULL DEFAULT 'on', PRIMARY KEY (`no`), UNIQUE (`id`), UNIQUE (`username`))";
    if (mysqli_query($db,$sql))
    {
      $_SESSION['fyear']=$year;
      $_SESSION['fbranch']=$branch;
      $_SESSION['fsection']=$section;
      header('location:select_list.php');
    }
    else
      echo $sql."Proble in finding data!";
 
  }
  else 
  {
      $_SESSION['fyear']=$year;
      $_SESSION['fbranch']=$branch;
      $_SESSION['fsection']=$section;
        header('location:select_list.php');
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>faculty Panel</title>
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

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top shadow">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="faculty_panel.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="faculty_history.php">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="student_data.php">Student</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="report.php">Report</a>
      </li>

    
    </ul>
    <ul class="navbar-nav border border-danger">
    	<li class="nav-item ">
        <span class="nav-link text-white text-center "><?php echo $_SESSION["faculty_name"];?></span>
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
      <h1>Attendence</h1>
    </div>
        <?php
    if (isset($_SESSION["msg"]))
    {
    echo "<div class='alert alert-info mt-2'>".$_SESSION["msg"]."</div>";
    unset($_SESSION['msg']);
    }
    ?>
  </div>
  <form action="" method="POST" class="container">
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

    <input type="submit" name="submit" class="btn btn-primary" value="submit">
  </form>
</div>
</div>
</body>
</html>