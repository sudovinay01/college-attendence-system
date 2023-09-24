<?php
session_start();
require("../db.php");
if(!isset($_SESSION["admin_username"]) OR !isset($_SESSION["admin_name"]))
{
  header('location:admin_login.php');
}

$count=0;
$delimiter = ",";
$filename = $_SESSION['branch']."-".$_SESSION['year']."-".$_SESSION["section"]."(".$_SESSION['from']." to ".$_SESSION['to'].").csv";
    $f = fopen('php://memory', 'w');
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
   $fields = array('ID', 'Name', 'Total %', 'No. of days', 'present');
    fputcsv($f, $fields, $delimiter);
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
   
     $lineData = array($row['id'], $row['name'], $p, $count, $present);
     fputcsv($f, $lineData, $delimiter);
  }
  fseek($f, 0);
      header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    fpassthru($f);
}
exit;
?>