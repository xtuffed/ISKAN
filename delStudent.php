<?php

require_once 'conn.php';


$id = $_GET['id'];
if (isset($_POST['done'])) {
	

	$sqlupdate = "DELETE FROM students WHERE studentID = '$id'";

	$resultupdate = $conn->query($sqlupdate);

	if (!$resultupdate) {
		echo '
				<script type = "text/javascript">
					alert("Error!");
					window.location = "managestudents.php";
				</script>
			';
	}
	else{
		echo '
				<script type = "text/javascript">
					alert("Sucessfully Removed");
					window.location = "managestudents.php";
				</script>
			';
	}
}

?>