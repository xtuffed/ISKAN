<?php 
require_once 'conn.php';


$sql = ("SELECT eventname, COUNT(*) as present from attendance_view, events where attendance_view.eventID in (1,2,3,4) and attendance_view.eventID = events.eventID group by eventname");
$query = $conn->query($sql);

$data = array();
foreach ($query as $row) {
	$data[] = $row;
}

print json_encode($data);
?>