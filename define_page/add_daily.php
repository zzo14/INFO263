<?php
include("../config/config.php");

$a=$_POST['event_id'];
$b=$_POST['group_id'];
$c=$_POST['day_of_week'];
$d=$_POST['start_time'];
$a = mysqli_real_escape_string($mysqli, $a);
$b = mysqli_real_escape_string($mysqli, $b);
$c = mysqli_real_escape_string($mysqli, $c);
$d = mysqli_real_escape_string($mysqli, $d);

$sql="call add_daily('$a', '$b', '$c', '$d')";//stored procedures
$query=mysqli_query($mysqli,$sql);

$arr[0] = $query;
echo json_encode($arr);
?>