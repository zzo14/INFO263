<?php
include("../config/config.php");

$a=$_POST['name'];
$b=$_POST['status'];
$a = mysqli_real_escape_string($mysqli, $a);
$b = mysqli_real_escape_string($mysqli, $b);

$sql="call add_event('$a', '$b')";//stored procedures
$query=mysqli_query($mysqli,$sql);

$sqla=mysqli_query($mysqli,"call get_event_id('$a')");//stored procedures
$res=mysqli_fetch_array($sqla);

//print_r($res);

$arr[0] =  $res['event_id'];
echo json_encode($arr);
?>