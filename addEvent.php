<?php
	session_start();
	require_once 'conn.php';


	if (isset($_POST['submit'])) {
		$eventname = $_POST['eventname'];
		$eventdate = $_POST['eventdate'];
		$description = $_POST['description'];
		$organization = $_POST['organization'];

		$sqlselect = "SELECT eventname, eventdate, orgID FROM organization WHERE eventname = '$eventname' and orgID = '$organization'";
		$sqlresult = $conn->query($sqlselect);
		$rowcount = $sqlresult->num_rows;

		if ($rowcount>0) {
			echo '
				<script type = "text/javascript">
					alert("Event already exists!");
					window.location = "eventshandled.php";
				</script>
			';
		}
		else {

			$sqlinsert = "INSERT INTO events (eventname, eventdate, description, orgID) VALUES('$eventname', '$eventdate', '$description','$organization')";

			$sqlresult1 = $conn->query($sqlinsert);

			if (!$sqlresult1) {
				echo '
				<script type = "text/javascript">
					alert("Error!");
					window.location = "eventshandled.php";
				</script>
			';
			}
			else{

				echo '
				<script type = "text/javascript">
					alert("Successfully Added");
					window.location = "eventshandled.php";
				</script>
			';


			}
		}
	}