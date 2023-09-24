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
     <script>
    if ( window.history.replaceState )
    {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>
    <style type="text/css">
      @media screen and (max-width: 500px) {
      .custom-control-inline{
        display: block;
      }
      }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top shadow">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link text-white" href="admin_panel.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_panel_faculty.php">Faculty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  " href="admin_panel_students.php">Students</a>
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
      <h1>Attendence data</h1>
    </div>
        <a href="admin_panel.php" class="btn btn-info pull-right">Back</a>
    <a href="exportData.php" class="btn btn-success pull-right">Report</a>
    <p>*scroll table horizontally for more details(in mobile view).</p>
<?php
$count=0;
$table=$_SESSION['branch']."-".$_SESSION['year']."-".$_SESSION["section"];
   $sql="SHOW COLUMNS FROM `".$table."` LIKE '____-__-__-_'";
    $result=mysqli_query($db,$sql);
    if (!$result)
    {
       echo 'Could not run query: ' . mysqli_error();
       exit;
    }
if (mysqli_num_rows($result) > 0) 
{
 $periods=mysqli_num_rows($result);
  while ($row = mysqli_fetch_assoc($result))
  {
    if (substr($row['Field'], 0, 10)>=$_SESSION['from'] AND substr($row['Field'], 0, 10)<=$_SESSION["to"])
     $column['"'.$count++.'"']=$row['Field'];
  }
  if (!isset($column))
  {
  $_SESSION['msg']="There is no data between given dates.";
    header('location:admin_panel.php');

  }
  $total=count($column);
  echo'<div class="table-responsive rounded">
     <table class="table table-bordered table-striped table-hover ">
     <thead class="thead-dark">
             <tr >
              <th >Id</th>
                <th >Name</th>
               <th >Total %</th>
               <th >total</th>
               <th >present</th>
               </tr>
               </thead>
    <tbody id="myTable">';
    $dates='';
for ($i=0; $i < $count ; $i++)
{ 
  if ($i!=$count-1)
  {
    $dates.="`".$column['"'.$i.'"']."`,";
  }
  else
    $dates.="`".$column['"'.$i.'"']."`";

}
  $sql="SELECT `id`,`name` FROM `".$table."` WHERE `status`='on'";
  $result=mysqli_query($db,$sql);
  while ($row = mysqli_fetch_array($result)) 
  {
    $present=0;
    $sql="select ".$dates." FROM `".$table."` WHERE `id`='".$row['id']."'";
    $resultx=mysqli_query($db,$sql);
    $rowx = mysqli_fetch_array($resultx);
    for ($i=0; $i < $count; $i++)
    { 
      if($rowx[$column['"'.$i.'"']]=='1')
        $present++;
    }
    $p=($present/$total)*100;
    $p=round($p, 2);
    echo "<td>".$row['id']."</td><td>".$row['name']."</td><td>".$p."</td><td>".$count."</td><td>".$present."</td></tr>";
  }
  echo "</tbody>
      </table>
      </div>";
}
?>
  
  </div>
</div>
</div>
</body>
</html>