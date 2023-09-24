<?php
session_start();
require("../db.php");
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
        <a class="nav-link" href="faculty_panel.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  text-white" href="faculty_history.php">History</a>
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
      <h1>Attendence history</h1>
    </div>
    <p>*scroll table horizontally for more details(in mobile view).</p>
        <?php
    if (isset($_SESSION["msg"]))
    {
    echo "<div class='alert alert-info mt-2'>".$_SESSION["msg"]."</div>";
    unset($_SESSION['msg']);
    }
    ?>
    <?php
    $sql="SELECT count(*) as total FROM `attend` WHERE `no`='".$_SESSION['fno']."'";
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    if($row['total'])
    {
    $sql="SELECT  `class`, `period`, `time`, `sub` FROM `attend` WHERE `no`='".$_SESSION['fno']."'";
    $result=mysqli_query($db,$sql);
    echo'
    <form method="POST" action="">
    <div class="table-responsive rounded">
     <table class="table table-bordered table-striped table-hover ">
     <thead class="thead-dark">
             <tr >
              <th >class(branch-year-section)</th>
               <th >period(yyyy-mm-dd-period)</th>
               <th >time</th>
               <th >subject</th>
               </tr>
               </thead>
    <tbody id="myTable">';
        while($row = mysqli_fetch_array($result))
      {
        
        echo '<tr><td>'.$row["class"].'</td>
        <td>'.$row["period"].'</td>
           <td>'.$row["time"].'</td>
           <td>'.$row["sub"].'</td>
          </tr>';

      }
      echo '</tbody></table>

       </div>
        </form>';
    }
    else
    {
      echo "No Data of attendence found.";
    }
    ?>
  </div>

</div>
</div>
</body>
</html>