<?php
include("../config/config.php");

$machine_group=$_POST['machine_group'];
$machine_group = mysqli_real_escape_string($mysqli, $machine_group);

$sql = "call get_group_id('$machine_group')";//stored procedures
$query=mysqli_query($mysqli,$sql);
$res=mysqli_fetch_array($query);

//print_r($res);

$arr[0] =  $res['group_id'];
echo json_encode($arr);
?>