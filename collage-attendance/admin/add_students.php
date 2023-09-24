<!--<br/><br><br><br>-->
<?php
session_start();
require("../db.php");
if(!isset($_SESSION["admin_username"]) OR !isset($_SESSION["admin_name"]))
{
  header('location:admin_login.php');
}
$error="";
if (isset($_POST['sumbit']))
{
  if(!preg_match('/^[\w]+$/', $_POST['id']) OR !preg_match('/^[\w ]+$/', $_POST['name']) OR !preg_match('/^[\w]+$/', $_POST['username'])OR !preg_match('/^[\w]+$/', $_POST['password']))
  {
    $error="<div class='alert alert-danger'>Invalid input.Only letters and numbers are allowed</div>";

  }
  else
  {
  $id=$_POST['id'];
  $name=$_POST['name'];
  $username=$_POST['username'];
  $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
  $sql="SELECT `username` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` WHERE `username`='$username'LIMIT 1";
    $result=mysqli_query($db,$sql);
  $row = mysqli_fetch_array($result);
  $sql2="SELECT `id` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` WHERE `id`='$id' LIMIT 1";
  $result=mysqli_query($db,$sql2);
  $row2 = mysqli_fetch_array($result);
  if ($row>0)
  {   $sql="SELECT `name`,`username` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` WHERE `username`='$username' AND `status`='off' LIMIT 1";
    $result=mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result);
      if ($row>0)
    {
      $_SESSION['unn']=$row['name'];
      $_SESSION['un']=$row['username'];
            $_SESSION['table']=$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection'];
    header('location:username_restore.php');
   }
     $error="<div class='alert alert-danger'>Username is not available.</div>";
  }
  else if($row2>0)
  {
    $sql="SELECT `name`,`id` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` WHERE `id`='$id' AND `status`='off' LIMIT 1";
    $result=mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result);
   if ($row>0)
    {
      $_SESSION['idn']=$row['name'];
      $_SESSION['id']=$row['id'];
      $_SESSION['table']=$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection'];
   header('location:id_restore.php');
   }

    $error=$sql2."<div class='alert alert-danger'>Id is already in use.</div>";
  }
  else
  {
  $sql="INSERT INTO `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."`(`id`, `name`, `username`, `password`) VALUES ('$id','$name','$username','$password')";
  if (mysqli_query($db,$sql))
    {
      $_SESSION["msg"]="Student <strong>$name</strong> is added.";
      header('location:students_list.php');
    }
    echo $sql2;

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
      <li class="nav-item">
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
<div class="flex card shadow ">
  <div class="card-body ">
    <div class="jumbotron">
      <h1>Add Student
       <?php
        echo $_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection'];
        ?></h1>
    </div>
    <a href="students_list.php"><button class="btn btn-warning">Back</button></a>
    <form action="" method="POST">
      <p><span class="text-danger">*</span>Only letters and numbers are allowed in fields.</p>
       <?php
    if($error!="")
    {
      echo $error;
      $error="";
    }
  ?>
    <div class="form-group ">
         <label>ID Number :</label>
         <input type="text" class="form-control border border-primary" name="id"  required="required">
       </div>
      <div class="form-group ">
         <label>Name:</label>
         <input type="text" class="form-control border border-primary" name="name"  required="required">
       </div> 
       <div class="form-group ">
         <label>Username:</label>
         <input type="text" class="form-control border border-primary" name="username"  required="required">
       </div>
       <div class="form-group">
         <label for="pwd">Password:</label>
         <input type="password" class="form-control border border-primary" id="pwd" name="password" required="required">
       </div>
<br/>
<br/>
    <input type="submit" name="sumbit" class="btn btn-primary">
  </form>
  </div>
</div>
</div>
</body>
</html>