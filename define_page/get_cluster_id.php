<?php
include("../config/config.php");

$cluster_name=$_POST['cluster_name'];
$cluster_name = mysqli_real_escape_string($mysqli, $cluster_name);


$sql = "call get_cluster_id('$cluster_name')";//stored procedures
$query=mysqli_query($mysqli,$sql);
$res=mysqli_fetch_array($query);

//print_r($res);

$arr[0] =  $res['cluster_id'];
echo json_encode($arr);
?>