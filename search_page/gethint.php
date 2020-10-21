<?php
include("../config/config.php");
$q=$_GET['q'];
$q=$mysqli->real_escape_string($q);

$sql = "call search('$q')";//stored procedures
$query=mysqli_query($mysqli,$sql);

//$res=mysqli_fetch_array($sql);
/*
$arr=array();
while($res=mysqli_fetch_row($sql)){
	array_push($arr,$res);
}
//print_r($arr);
echo json_encode($arr);
*/

//print_r($res['event_name']);

while($res=mysqli_fetch_array($query)){
    echo ($res['event_name']);
    echo "<br>";
}

?>