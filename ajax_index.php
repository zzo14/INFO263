<?php
require_once ("config/config.php");

$date1=$_GET['date1'];
$date2=$_GET['date2'];

$date1=mysqli_real_escape_string($mysqli, $date1);
$date2=mysqli_real_escape_string($mysqli, $date2);

$query="call search_event('$date1', '$date2')";//stored procedures

$qry_result=$mysqli->query($query);

if($qry_result->num_rows==0)
{
    echo json_encode(['data'=>'<h2>No matching records found</h2>','sql'=>$query]);
    return ;
}

$display_string ="<tr>";
$display_string .="<td>Event Name</td>";
$display_string .="<td>Cluster Name</td>";
$display_string .="<td>Cluster ID</td>";
$display_string .="<td>Machine Group</td>";
$display_string .="<td>Group ID</td>";
$display_string .="<td>Date</td>";
$display_string .="<td>Time</td>";
$display_string .="<td>Activate</td>";
$display_string .="</tr>";

//insert a new row in the table for each person returned
while($row=mysqli_fetch_object($qry_result)){
    $display_string.="<tr>";
    $display_string.="<td>$row->event_name</td>";
    $display_string.="<td>$row->cluster_name</td>";
    $display_string.="<td>$row->cluster_id</td>";
    $display_string.="<td>$row->machine_group</td>";
    $display_string.="<td>$row->group_id</td>";
    $display_string.="<td>$row->date</td>";
    $display_string.="<td>$row->time</td>";
    $display_string.="<td>$row->activate</td>";
    $display_string.="</tr>";
}

echo json_encode(['data'=>$display_string,'sql'=>$query]);
?>