<?php
session_start();
require("../db.php");
$x=1;
$column=$_SESSION["fdate"]."-".$_SESSION["fperiod"];
if(!isset($_SESSION["faculty_username"]) OR !isset($_SESSION["faculty_name"]))
{
  header('location:faculty_login.php');
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
      <h1>Attendence<br/>(absent)<?php echo '<br/>('.$_SESSION['fyear'].'-'.$_SESSION['fbranch'].'-'.$_SESSION['fsection'].')<br/>Date-'.$_SESSION['fdate'].' /Time - '.$_SESSION['ftime'].'<br/>Period - '.$_SESSION['fperiod'];?></h1>
    </div>
      <a href="attendence.php"><button class="btn btn-warning">Back</button></a>
      <p>Attendence completed</p>
 <input class="form-control my-2 border border-primary" id="myInput" type="text" placeholder="Search..">
   <?php
  $sql="SELECT `id`,`name`,`".$_SESSION["fdate"]."-".$_SESSION["fperiod"]."` FROM `".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION["fsection"]."` where `".$column."`='0'";
  $result=mysqli_query($db,$sql);
echo'
    <div class="table-responsive rounded">
     <table class="table table-bordered table-striped table-hover ">
     <thead class="thead-dark">
     <tr >
              <th>Name</th>
               <th >Id</th>
               </tr>
               </thead>
    <tbody id="myTable">';
  while($row = mysqli_fetch_array($result))
  {
    echo '<tr><td>'.$row["id"].'</td>
             <td>'.$row["name"].'</td></tr>';  
             $x=0;
  }
  echo '</tbody></table>
    </div>
  </form>';
 if($x!=0)
  echo "<h2>Today no absenties.</h2>";
  ?>
<a href="faculty_panel.php"><button class="btn btn-primary">Finish</button></a>
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