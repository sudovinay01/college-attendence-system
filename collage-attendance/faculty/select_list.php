<?php
session_start();
require("../db.php");
date_default_timezone_set("Asia/Calcutta"); 
if(!isset($_SESSION["faculty_username"]) OR !isset($_SESSION["faculty_name"]))
{
  header('location:faculty_login.php');
}

if (isset($_POST["submit"]))
{
  $subject=$_POST['subject'];
  $period=$_POST['period'];
  $_SESSION['fsubject']=$_POST['subject'];
  $_SESSION['fperiod']=$_POST['period'];
  $date=date("Y-m-d");
  $_SESSION['fdate']=$date;
  $column=$_SESSION["fdate"]."-".$_SESSION["fperiod"];
  $sql="SHOW COLUMNS FROM `".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION['fsection']."` LIKE '".$_SESSION["fdate"]."-".$_SESSION["fperiod"]."'";
  $result = mysqli_query($db,$sql);
  $exists = (mysqli_num_rows($result))?TRUE:FALSE;
  if(!$exists)
  {
    $sql="ALTER TABLE `".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION['fsection']."` ADD `".$_SESSION["fdate"]."-".$_SESSION["fperiod"]."` INT NOT NULL DEFAULT '1'";
    if (mysqli_query($db,$sql))
    {
      $_SESSION['ftime']=date("h:i:sa");
      $sql="INSERT INTO `attend`(`no`, `name`, `class`, `period`, `time`,`sub`) VALUES ('".$_SESSION['fno']."','".$_SESSION['faculty_name']."','".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION["fsection"]."','".$column."','".date("h:i:sa")."','".$_SESSION['fsubject']."')";
      if (mysqli_query($db,$sql))
        header('location:attendence.php');
    }
  }
  else
  {
    $sql="SELECT `no`,`name`,`sub` FROM `attend` WHERE `class`='".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION["fsection"]."' AND `period`='".$column."' LIMIT 1";
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    if ($_SESSION['fno']==$row['no'])
    {
      $_SESSION['ftime']=date("h:i:sa");
       header('location:attendence.php');
    }
    else
     $_SESSION["msg"]="Attendence of <strong>".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION["fsection"]."</strong> of date <strong>".$_SESSION['fdate']."</strong> period - <strong>".$_SESSION['fperiod']."</strong> is taken by <strong>".$row['name']."</strong> id - <strong>".$row['no']."</strong> subject -<strong> ".$row['sub'].  "</strong><br/>Please contact respected faculty for any issue.";
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
        <a class="nav-link  " href="faculty_history.php">History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="student_data.php">Student</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="report.php">Report</a>
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
      <h1>Attendence-<?php
       echo $_SESSION['fyear'].'-'.$_SESSION['fbranch'].'-'.$_SESSION['fsection']?></h1>
    </div>
    <?php
    if (isset($_SESSION["msg"]))
    {
    echo "<div class='alert alert-info mt-2'>".$_SESSION["msg"]."</div>";
    unset($_SESSION['msg']);
    }
    ?>
      <a href="faculty_panel.php"><button class="btn btn-warning">Back</button></a>
  </div>
  <div class="container">
  <form action="" method="POST" >
   <div class="form-group">
         <label>period</label>
         <input type="number" class="form-control border border-primary" name="period"  required="required" min="1" max="7" >
       </div>
          <div class="form-group ">
         <label>subject</label>
         <input type="text" class="form-control border border-primary" name="subject"  required="required">
       </div>

    <input type="submit" name="submit" class="btn btn-primary" value="submit">
  </form>
  </div>
</div>
</div>
</body>
</html>