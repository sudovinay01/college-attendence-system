<?php
session_start();
require("../db.php");
if(!isset($_SESSION["student_username"]) OR !isset($_SESSION["student_name"]))
{
  header('location:student_login.php');
}
$table=$_SESSION['sbranch'].'-'.$_SESSION['syear'].'-'.$_SESSION['ssection'];
$count=0;
$last_date='';
$present=0;
$non=0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Panel</title>
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
        <a class="nav-link text-white" href="#">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav border border-danger">
    	<li class="nav-item ">
        <span class="nav-link text-white text-center "><?php echo $_SESSION["student_name"];?></span>
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
    <div class="jumbotron" >
      <h1>Attendence details</h1>
    </div>
    <div class="table-responsive rounded">
     <table class="table table-bordered table-striped table-hover ">
      <tr>
        <td>Total % </td>
        <td id="total"></td>
      </tr>
      <tr>
        <td>Working days </td>
        <td id="days"></td>
      </tr>
      <tr>  
        <td>present </td>
        <td id="present"></td>
      </tr>
    </table>
    </div>

     <input class="form-control my-2 border border-primary" id="myInput" type="text" placeholder=" Search .. YYYY-MM-DD or YYYY or MM or DD ">
     <?php 
    if (isset($_SESSION["msg"]))
    {
    echo "<div class='alert alert-info mt-2'>".$_SESSION["msg"]."</div>";
    unset($_SESSION['msg']);
    }
    $sql="SHOW COLUMNS FROM `".$table."` LIKE '____-__-__-_'";
    $result=mysqli_query($db,$sql);
if (!$result) {
    echo 'Could not run query: ' . mysqli_error();
    exit;
}
if (mysqli_num_rows($result) > 0) 
{
 while ($row = mysqli_fetch_assoc($result))
 {
    $column['"'.$count++.'"']=$row['Field'];
  }
    sort($column);
    $total=count($column);

}
echo'<div class="table-responsive rounded">
     <table class="table table-bordered table-striped table-hover ">
     <thead class="thead-dark">
             <tr >
              <th >date<br/>(yyyy-mm-dd)</th>
               <th >1</th>
               <th >2</th>
               <th >3</th>
               <th >4</th>
               <th >5</th>
               <th >6</th>
               <th >7</th>
               </tr>
               </thead>
    <tbody id="myTable">';
foreach ($column as $cur)
{
  $date=substr($cur, 0, 10);
  if ($last_date!=$date)
  {
    if ($non!=0) {
      echo "</tr>";

    }
  echo "<tr><td>".$date."</td>";
  $non=1;
  $last_date=$date;
  }
    $sql="SELECT `".$cur."` FROM `".$table."` WHERE `username`='".$_SESSION['student_username']."'";
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    if ($row[$cur]=='1') {
      $present++;
      echo "<td>P</td>";
    }
    else
      echo "<td>A</td>";

}
echo "</tr></tbody>
      </table>
      </div>";
    $p=($present/$total)*100;
    $p=round($p, 2);
    echo '<script>
    document.getElementById("total").innerHTML = "'.$p.'";
    document.getElementById("days").innerHTML = "'.$total.'";
    document.getElementById("present").innerHTML = "'.$present.'";
</script>';
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