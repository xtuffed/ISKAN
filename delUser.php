<?php

require_once 'conn.php';


$id = $_GET['id'];
if (isset($_POST['done'])) {
	

	$sqlupdate = "DELETE FROM users WHERE id = '$id'";

	$resultupdate = $conn->query($sqlupdate);

	if (!$resultupdate) {
		echo '
				<script type = "text/javascript">
					alert("Error!");
					window.location = "manageUsers.php";
				</script>
			';
	}
	else{
		echo '
				<script type = "text/javascript">
					alert("Sucessfully Removed");
					window.location = "manageUsers.php";
				</script>
			';
	}
}

?>