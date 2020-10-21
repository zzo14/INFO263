<?php
require("../config/config.php");

$a=$_POST['event_id'];
$b=$_POST['week_of_year'];
$c=$_POST['event_year'];
$a = mysqli_real_escape_string($mysqli, $a);
$b = mysqli_real_escape_string($mysqli, $b);
$c = mysqli_real_escape_string($mysqli, $c);

$sql="call add_weekly('$a', '$b', '$c')";//stored procedures
$query=mysqli_query($mysqli,$sql);

$arr[0] =  $query;
echo json_encode($arr);
?>