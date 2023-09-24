<?php
session_start();
require("../db.php");
if(!isset($_SESSION["faculty_username"]) OR !isset($_SESSION["faculty_name"]))
{
  header('location:faculty_login.php');
}
$column=$_SESSION["fdate"]."-".$_SESSION["fperiod"];

if (isset($_POST["submit"]))
{
  $sql="SELECT `id` FROM `".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION["fsection"]."`";
  $result=mysqli_query($db,$sql);
   while($row = mysqli_fetch_array($result))
   {  
    $value=$row["id"];
    $valuex=$_POST["$value"];
    
    $sqlx="UPDATE `".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION["fsection"]."` SET `".$column."`=".$valuex." WHERE `id`='$value'";
    mysqli_query($db,$sqlx);
   }
   $_SESSION["msg"]=" ".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."(".$_SESSION['fsection'].") period - ".$_SESSION["fperiod"]." Attendence completed";
 header('location:finish.php');
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
      <h1>Attendence<?php echo '<br/>('.$_SESSION['fyear'].'-'.$_SESSION['fbranch'].'-'.$_SESSION['fsection'].')<br/>Date-'.$_SESSION['fdate'].' /Time - '.$_SESSION['ftime'].'<br/>Period - '.$_SESSION['fperiod'];?></h1>
    </div>
      <a href="select_list.php"><button class="btn btn-warning">Back</button></a>
 <input class="form-control my-2 border border-primary" id="myInput" type="text" placeholder="Search..">
 <p>*scroll table horizontally for more details(in mobile view).</p>
    <?php
    $sql="SELECT count(`id`) as total FROM `".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION['fsection']."` WHERE `status`='on'";
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    if($row['total'])
    {
    $sql="SELECT `id`,`name`,`".$_SESSION["fdate"]."-".$_SESSION["fperiod"]."` FROM `".$_SESSION["fbranch"]."-".$_SESSION["fyear"]."-".$_SESSION['fsection']."` WHERE `status`='on'";
    $result=mysqli_query($db,$sql);
    echo'
    <form method="POST" action="">
    <div class="table-responsive rounded">
     <table class="table table-bordered table-striped table-hover ">
     <thead class="thead-dark">
             <tr >
              
               <th >Id</th>
               <th ></th>
               <th></th>
               <th >Name</th>
               </tr>
               </thead>
    <tbody id="myTable">';
        while($row = mysqli_fetch_array($result))
      {
        
        echo '<tr>
        <td>'.$row["id"].'</td>
              <td> <input type="radio" name="'.$row["id"].'" value="1" required="on"  class="w3-radio" ';
            if($row["$column"]=="1")
            {
              echo "checked";
            }
            echo'>Present</td><td>
        <input type="radio" name="'.$row["id"].'" value="0" ';
        if($row["$column"]=="0")
            {
              echo "checked";
            }
            echo '>Absent<br/></td>
            <td>'.$row["name"].'</td>
          </tr>';

      }
      echo '<tr><td colspan="4"><input type="submit" name="submit" class="btn btn-primary" value="submit" ></td></tr></tbody></table>

       </div>
        </form>';
    }
    else
    {
      echo "No Data of students found.Please contact admin.";
    }
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