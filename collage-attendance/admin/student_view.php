<?php
session_start();
require("../db.php");
$no=$_GET["no"];
if(!isset($_SESSION["admin_username"]) OR !isset($_SESSION["admin_name"]))
{
  header('location:admin_login.php');
}
elseif (!isset($_GET["no"]) OR !preg_match('/^[0-9]+$/', $no)) 
{
	 header('location:students_list.php');
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel Faculty</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top shadow">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="admin_panel.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="admin_panel_faculty.php">Faculty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  text-white" href="admin_panel_students.php">Students</a>
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
      <h1>Student View
      <?php
        echo $_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection'];
        ?></h1>
    </div>
     <div class="clearfix">
     <a href="students_list.php"><button type="button" class="btn btn-warning float-left mb-2">Back</button></a>
      </div>
 	<?php
  	$sql="SELECT `no`,`id`,`name` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` where `no`='$no' AND `status`='on'";
  	 $result=mysqli_query($db,$sql);
  	 $row = mysqli_fetch_array($result);
  	  echo '
  	  <div class="table-responsive">
      		<table class="table table-bordered table-striped table-hover">
      		<tr>
      			<td style="width:20%;">ID</td>
      			<td style="width:80%;">'.$row['id'].'</td>
      		</tr>
      		<tr>
      			<td>Name</td>
      			<td>'.$row['name'].'</td>
      		</tr>

      		</table>
      	</div>';
 	?>
    </div>
  
  </div>
 </div>

</body>
</html>