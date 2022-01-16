<?php
	session_start();
	require_once 'conn.php';


	if (isset($_POST['submit'])) {
		$orgcode = $_POST['orgcode'];
		$orgname = $_POST['orgname'];

		$sqlselect = "SELECT orgCode FROM organization WHERE orgCode = '$orgcode'";
		$sqlresult = $conn->query($sqlselect);
		$rowcount = $sqlresult->num_rows;

		if ($rowcount>0) {
			echo '
				<script type = "text/javascript">
					alert("Organization already exists!");
					window.location = "manageOrg.php";
				</script>
			';
		}
		else {

			$sqlinsert = "INSERT INTO organization (orgCode, orgName) VALUES('$orgcode', '$orgname')";

			$sqlresult1 = $conn->query($sqlinsert);

			if (!$sqlresult1) {
				echo '
				<script type = "text/javascript">
					alert("Error!");
					window.location = "manageOrg.php";
				</script>
			';
			}
			else{

				echo '
				<script type = "text/javascript">
					alert("Saved Record");
					window.location = "manageOrg.php";
				</script>
			';


			}
		}
	}