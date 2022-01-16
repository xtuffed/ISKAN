<?php
	session_start();
	require_once 'conn.php';


	if (isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$type = $_POST['type'];
		$organization = $_POST['organization'];

		$sqlselect = "SELECT username FROM users WHERE username = '$username'";
		$sqlresult = $conn->query($sqlselect);
		$rowcount = $sqlresult->num_rows;

		if ($rowcount>0) {
			echo '
				<script type = "text/javascript">
					alert("Username already exists!");
					window.location = "manageUsers.php";
				</script>
			';
		}
		else {

			$sqlinsert = "INSERT INTO users (username, first_name, last_name, email, password, type, orgID) VALUES('$username', '$firstname', '$lastname', '$email', '$password', '$type', '$organization')";

			$sqlresult1 = $conn->query($sqlinsert);

			if (!$sqlresult1) {
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
					alert("Saved Record");
					window.location = "manageUsers.php";
				</script>
			';


			}
		}
	}