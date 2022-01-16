<?php 
require_once 'conn.php';

$id1 = $_GET['id'];

if (isset($_POST['done'])) {
	$org = $_POST['org'];

	$sqlorg = "SELECT * FROM orgstudent WHERE studentID = '$id1' and orgID = '$org'";
	$sqlorgresult = $conn->query($sqlorg);
	$sqlorgdata = $sqlorgresult->fetch_assoc();
	$sqlorgrow = $sqlorgresult->num_rows;

	if ($sqlorgrow>0) {
		echo '
				<script type = "text/javascript">
					alert("Already Registered");
					window.location = "managestudents.php";
				</script>
			';
	}
	else{
		$sqlorginsert = "INSERT INTO orgstudent(orgID, studentID) VALUES('$org','$id1')";

		$sqlorginsertresult = $conn->query($sqlorginsert);

		if (!$sqlorginsertresult) {
			echo '
				<script type = "text/javascript">
					alert("Error!");
					window.location = "managestudents.php";
				</script>
			';		}
		else{
			echo '
				<script type = "text/javascript">
					alert("Successfully Registered");
					window.location = "managestudents.php";
				</script>
			';
		}
	}
}


?>