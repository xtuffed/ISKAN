a<?php
	session_start();
	require_once 'conn.php';
	include 'C:\xampp\htdocs\Iskan\phpqrcode\qrlib.php'; 

	$folderTemp = 'gqrcode';
	if (isset($_POST['submit'])) {
		$idnumber = $_POST['idnumber'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$course = $_POST['course'];
		$yearlevel = $_POST['yearlevel'];

		$sqlselect = "SELECT idnumber FROM students WHERE idnumber = '$idnumber'";
		$sqlresult = $conn->query($sqlselect);
		$rowcount = $sqlresult->num_rows;

		if ($rowcount>0) {
			echo '
				<script type = "text/javascript">
					alert("ID Number already exists!");
					window.location = "managestudents.php";
				</script>
			';

		} else {

			/*Algorithm for QR Generator*/



			$sqlinsert = "INSERT INTO students (idnumber, first_name, last_name, yearlevel, course) VALUES('$idnumber', '$firstname', '$lastname', '$yearlevel', '$course')";

			$sqlresult1 = $conn->query($sqlinsert);

			if (!$sqlresult1) {
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
					alert("Saved Record");
					window.location = "managestudents.php";
				</script>
			';


			}
		}
	}