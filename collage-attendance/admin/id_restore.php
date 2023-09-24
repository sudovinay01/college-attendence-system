<!-<br/><br><br><br>-->
<?php
session_start();
require("../db.php");
if(!isset($_SESSION["admin_username"]) OR !isset($_SESSION["admin_name"]))
{
  header('location:admin_login.php');
}
if(!isset($_SESSION['id']))
{
  header('location:admin_panel_students.php');
}

$error="";
if (isset($_POST['restore']))
{
   $sql="UPDATE `".$_SESSION["table"]."` SET `status`='on' WHERE `username`='".$_SESSION['id']."' AND `status`='off' LIMIT 1";
     if (mysqli_query($db,$sql))
    {
      if ( $_SESSION["table"]=='faculty')
      {
        $_SESSION["msg"]="Faculty <strong>".$_SESSION['unn']."</strong> is restored.";
      unset($_SESSION['id']);
      header('location:admin_panel_faculty.php');
      }
      else
      {
      $_SESSION["msg"]="Student <strong>".$_SESSION['unn']."</strong> is restored.";
      unset($_SESSION['id']);
      header('location:students_list.php');
      }
    }
}
if (isset($_POST['sumbit']))
{
  if(!preg_match('/^[\w]+$/', $_POST['username']) OR !preg_match('/^[\w ]+$/', $_POST['name']) OR !preg_match('/^[\w]+$/', $_POST['password']))
  {
    $error="<div class='alert alert-danger'>Invalid input.Only letters and numbers are allowed</div>";

  }
  else
  {
   $username=$_POST['username'];
  $name=$_POST['name'];
  $id=$_SESSION['id'];
  $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
  if (isset($_SESSION['id'])) 
  {
    $sql="UPDATE `".$_SESSION["table"]."` SET `username`='".$username."',`name`='".$name."',`password`='".$password."',`status`='on' WHERE `id`='".$_SESSION['id']."' AND `status`='off' LIMIT 1";
    if (mysqli_query($db,$sql))
    {
      if ($_SESSION["table"]=='faculty')
      {
        $_SESSION["msg"]="Faculty <strong>$name</strong> is added.";
       unset($_SESSION['un']);
       header('location:admin_panel_faculty.php');
      }
      else
      {
       $_SESSION["msg"]="Student <strong>$name</strong> is added.";
       unset($_SESSION['un']);
       header('location:students_list.php');
      }
    }
  }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel Students</title>
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
      <h1>ID already used</h1>
    </div>
    <a href="add_students.php"><button class="btn btn-warning mb-2">Back</button></a>
           <?php
    if($error!="")
    {
      echo $error;
      $error="";
    }
  ?>
  <form action="" method="POST" class="container ">
    <div class="container bg-success text-white p-3 rounded">
      <h2>1)Restoring</h2>
      <p>Are you trying to restore account with id - <?php echo $_SESSION['id'].' and  Name - '.$_SESSION['unn'];?></p>*Use this if u have accidentally removed this account  
      </p>
       <input type="submit" name="restore" value="yes" class="btn btn-primary">
    </div>
  </form>
    <form action="" method="POST" class="container ">
        <div class="container p-3 rounded">
      <h2>2)New account</h2>
      <p>Are you trying to create new account with id - <?php echo $_SESSION['id'];?></p>if yes type id,name & password
      </p>
    </div>
      <p><span class="text-danger">*</span>Only letters and numbers are allowed in fields.</p>

     <div class="form-group ">
         <label>Username:</label>
         <input type="text" class="form-control border border-primary" name="username"  required="required">
       </div>
      <div class="form-group ">
         <label>Name:</label>
         <input type="text" class="form-control border border-primary" name="name"  required="required">
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