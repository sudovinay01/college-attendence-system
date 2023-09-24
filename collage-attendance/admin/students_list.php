<?php
session_start();
require("../db.php");
if(!isset($_SESSION["admin_username"]) OR !isset($_SESSION["admin_name"]))
{
  header('location:admin_login.php');
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
        <a class="nav-link" href="admin_panel_faculty.php">Faculty</a>
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
      <h1>Students List
        <?php
        echo $_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection'];
        ?></h1>
    </div>
    <a href="admin_panel_students.php"><button type="button" class="btn btn-warning mb-1 mr-1">Back</button></a>
  
     <a href="add_students.php"><button type="button" class="btn btn-primary mb-1">Add Student</button></a><br/>
       <form method="POST" action="import_csv_students.php" class=" bg-light text-dark border border-primary pb-2 rounded" enctype="multipart/form-data" >
        
          <div class="custom-file m-2">
            <p>Add students bulk</p>
    <label>upload csv (for bulk upload) </label><br/>
    Fields should be -<br/>Id,Name,Username,Password<br/>
       <input type="file" id="customFile" name="file" required="required" class=" border border-primary">
       <button type="submit" id="submit" name="submit"class="btn btn-primary my-2 mb-3">Import</button>
       </div>
     </form>
  
    <p>*scroll table horizontally for more details(in mobile view).</p>
            <?php 
    if (isset($_SESSION["msg"]))
    {
    echo "<div class='alert alert-info mt-2'>".$_SESSION["msg"]."</div>";
    unset($_SESSION['msg']);
    }
    ?>
       <input class="form-control my-2 border border-primary" id="myInput" type="text" placeholder="Search..">
    <?php 
    if (isset($_SESSION["msg"]))
    {
    echo "<div class='alert alert-info mt-2'>".$_SESSION["msg"]."</div>";
    unset($_SESSION['msg']);
    }
    $sql="SELECT count(`id`) as total FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` where `status`='on'";
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    if($row['total']>0)
    {
      $sql="SELECT `no`,`id`,`name` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` where `status`='on'";
      $result=mysqli_query($db,$sql);
      echo '<div class="table-responsive rounded">
      <table class="table table-bordered table-striped table-hover ">
    <thead class="thead-dark">
      <tr>
        <th style="width:20%;">Id</th>
        <th style="width:40%;">Name</th>
        <th style="width:10%;">View</th>
        <th style="width:10%;">Edit</th>
        <th style="width:10%;">Remove</th>
      </tr>
    </thead>
    <tbody id="myTable">';
    while($row = mysqli_fetch_array($result))
    {
      echo'<tr>
        <td>'.$row["id"].'</td>
        <td>'.$row["name"].'</td>';
     echo '<td><a href="student_view.php?no='.$row['no'].'"><span class="btn btn-primary" >View</span></a></td>
    <td><a href="student_edit.php?no='.$row['no'].'"><span class="btn btn-warning" >Edit</span></a></td><td><a href="student_remove.php?no='.$row['no'].'"><span class="btn btn-danger" >Remove</span></a></td>
      </tr>';
    }

    } 
   else
   {
    echo '<div class="alert alert-warning"><strong>No data of students.</strong></div>';
    }
    echo "</tbody>";
    ?>
  </div>
</div>
</div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>
</html>