<?php
session_start();
require("../db.php");
if(!isset($_SESSION["admin_username"]) OR !isset($_SESSION["admin_name"]))
{
  header('location:admin_login.php');
}
if(isset($_POST["submit"]))
{

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
        <a class="nav-link text-white" href="admin_panel_faculty.php">Faculty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin_panel_students.php">Students</a>
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
            <h1>Add Faculty(csv)</h1>
        </div>
        <a href="admin_panel_faculty.php"><button class="btn btn-info">Done</button></a>
        
<?php 
$filename=$_FILES["file"]["name"];
if (move_uploaded_file($_FILES['file']['tmp_name'], __DIR__.'./faculty_data/'. $_FILES["file"]['name'])) {
    echo '<div class="container alert alert-success">
  File uploaded successfully
  </div>';
} else {
     echo '<div class="container alert alert-danger">
  File has not uploaded
  </div>';
}
$ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));
//we check,file must be have csv extention
if($ext==".csv")
{
    echo '    <p><span class="text-danger">*</span>Only letters and numbers are allowed in fields.</p>
    <p><span class="text-danger">*</span>Fields should be - Id,Name,Username,Password,Branch[cse,ece,civil,has(h&s)].</p>
    <div class="table-responsive rounded">
      <table class="table table-bordered table-striped table-hover ">
    <thead class="thead-dark">
      <tr>
        <th style="width:30%;">Status</th>
        <th style="width:5%;">Id</th>
        <th style="width:40%;">Name</th>
        <th style="width:10%;">Username</th>
        <th style="width:10%;">Password</th>
        <th style="width:5%;">Branch</th>
      </tr>
    </thead>
    <tbody id="myTable">';
  $file = fopen('./faculty_data/'.$filename, "r");
         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
         {
          $passwordx=$emapData[3];
            if (!isset($emapData[0]) OR !isset($emapData[1]) OR !isset($emapData[2]) OR !isset($emapData[3]) OR !isset($emapData[4])) 
            {
                echo "<tr><td colspan='6' class='bg-danger text-white'>Invalid data given.Please follow given rules.</td></tr>";
            }
            else
            {
                $sql="SELECT `username` FROM `faculty` WHERE `username`='".$emapData[2]."' LIMIT 1";
                $result=mysqli_query($db,$sql);
                $row = mysqli_fetch_array($result);
                $sql2="SELECT `id` FROM `faculty` WHERE `id`='".$emapData[0]."' LIMIT 1";
                $result=mysqli_query($db,$sql2);
                 $row2 = mysqli_fetch_array($result);
                if ($row>0)
                    {   
                      $sql="SELECT `username` FROM `faculty` WHERE `username`='".$emapData[2]."' AND `status`='off' LIMIT 1";
                      $result=mysqli_query($db,$sql);
                      $row = mysqli_fetch_array($result);
                      if ($row>0)
                      {
                        echo '<tr><td class="bg-danger text-white" > Enter this data manually . </td>';

                       }
                       else
                 echo '<tr><td class="bg-danger text-white" > Username <strong>'.$emapData[0].'</strong> is not available.</td>';

                 }
                  else if($row2>0)
                 {
                  $sql="SELECT `name`,`id` FROM `faculty` WHERE `id`='".$emapData[0]."' AND `status`='off' LIMIT 1";
                  $result=mysqli_query($db,$sql);
                  $row = mysqli_fetch_array($result);
                 if ($row>0)
                {
                    $sql="SELECT `name`,`id` FROM `".$_SESSION["abranch"]."-".$_SESSION["ayear"]."-".$_SESSION['asection']."` WHERE `id`='".$emapData[0]."' AND `status`='off' LIMIT 1";
                     $result=mysqli_query($db,$sql);
                     $row = mysqli_fetch_array($result);
                    if ($row>0)
                  echo '<tr><td class="bg-danger text-white">Enter this data manually . </td></tr>';
                 }
                 else
                 echo '<tr><td class="bg-danger text-white"> Id <strong>'.$emapData[0].'</strong> is not available.</td></tr>';
                 }


                  else
                 {
                   $emapData[4]=strtolower($emapData[4]);
               echo'<tr>';
                    if(!preg_match('/^[\w]+$/', $emapData[0]) OR !preg_match('/^[\w ]+$/', $emapData[1]) OR !preg_match('/^[\w]+$/', $emapData[2]) OR !preg_match('/^[\w]+$/', $emapData[3]) OR !preg_match('/cse|civil|ece|has/', $emapData[4]))
                       {
                        echo '<td class="bg-danger text-white">Failed(check input data)</td>';
                         }
                       else
                        {
                          
                          $emapData[3]=password_hash($emapData[3], PASSWORD_DEFAULT);
                     $sql = "INSERT INTO `faculty`(`id`,`name`, `username`, `password`, `branch`) VALUES ('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]')";
                     if(mysqli_query($db, $sql))
                       echo '<td class="bg-success text-white">Success</td>';

                         }

                  }
                                              echo'
                    <td>'.$emapData[0].'</td>
                    <td>'.$emapData[1].'</td>
                  <td>'.$emapData[2].'</td>
                        <td>'.$passwordx.'</td>
                  <td>'.$emapData[4].'</td></tr>';
                    
                    echo"</tbody>";
             }
         }
         fclose($file);

}
else 
{
    unlink('./faculty_data/'.$filename) or die("Couldn't delete file");
    echo"<div class='container alert alert-danger'>Error: Please Upload only CSV File</div>";

}
 
 
}
?>
  </div>
</div>
</div>
</body>
</html>