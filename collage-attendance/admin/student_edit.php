<?php
session_start();
require("../db.php");
$no=$_GET["no"];
$error="";
if(!isset($_SESSION["admin_username"]) OR !isset($_SESSION["admin_name"]))
{
  header('location:admin_login.php');
}
elseif (!isset($_GET["no"]) OR !preg_match('/^[0-9]+$/', $no)) 
{
   header('location:students_list.php');
}

if (isset($_POST['sumbit']))
{
  if(!preg_match('/^[\w]+$/', $_POST['id']) OR !preg_match('/^[\w ]+$/', $_POST['name']))
  {
    $error="<div class='alert alert-danger'>Invalid input.Only letters and numbers are allowed</div>";

  }
  else
  {
  $id=$_POST['id'];
  $name=$_POST['name'];


  $sql2="SELECT `id` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` WHERE `id`='$id' AND `no`!='$no' LIMIT 1";
  $result=mysqli_query($db,$sql2);
  $row2 = mysqli_fetch_array($result);
  if (false)
  { 
    $error="<div class='alert alert-danger'> Username is not available.</div>";
  }
  else if($row2>0)
  {
    $error="<div class='alert alert-danger'> Id is already in use.</div>";
  }
  else
  {
  $sql="UPDATE `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` SET `id`='$id',`name`='$name' WHERE `no`='$no'";
  if (mysqli_query($db,$sql))
    {
      $_SESSION["msg"]="Student <strong>$name</strong> is updated.";
      header('location:students_list.php');
    }
    echo $sql;

    }
  }
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
        <a class="nav-link" href="admin_panel.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="admin_panel_faculty.php">Faculty</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-white" href="admin_panel_students.php">Students</a>
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
      <h1>Student Edit
      <?php
        echo $_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection'];
        ?></h1>
    </div>
     <div class="clearfix">
     <a href="students_list.php"><button type="button" class="btn btn-warning float-left mb-2">Back</button></a>
      </div>
 	<?php
  	$sql="SELECT `no`,`id`,`name` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` where `no`='$no' AND `status`='on' LIMIT 1";
  	 $result=mysqli_query($db,$sql);
  	 $row = mysqli_fetch_array($result);
  	  echo '<form action="" method="POST">
            <p><span class="text-danger">*</span>Only letters and numbers are allowed in fields.</p>';
          
    if($error!="")
    {
      echo $error;
      $error="";
    }

 echo' <div class="form-group ">
         <label>ID Number :</label>
         <input type="text" class="form-control border border-primary" name="id" value="'.$row['id'].'"  required="required" readonly="readonly">
       </div>
      <div class="form-group ">
         <label>Name:</label>
         <input type="text" class="form-control border border-primary" name="name" value="'.$row['name'].'" required="required">
       </div> 
    <input type="submit" name="sumbit" class="btn btn-primary">
  </form>';
 	?>
    </div>
  
  </div>
 </div>

</body>
</html>