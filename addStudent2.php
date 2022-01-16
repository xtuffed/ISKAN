<?php
	session_start();
	require_once 'conn.php';
	include 'C:\xampp\htdocs\Iskan\phpqrcode\qrlib.php'; 

	$folderTemp = 'gqrcode/';
	if (isset($_POST['submit'])) {
		$a = $_POST['idnumber'];
		$b = $_POST['firstname'];
		$c = $_POST['lastname'];
		$d = $_POST['course'];
		$e = $_POST['yearlevel'];
		$f = $a;
		$g = $c.".png"
		$qual = 'H';
		$size = 6;
		$padding = 0;
		QRCode :: png($d,$folderTemp.$e,$qual,$size,$padding);
		
		//Duplicate Checker
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



			$sqlinsert = "INSERT INTO students (idnumber, first_name, last_name, yearlevel, course, qrcode) VALUES('$a', '$b', '$c', '$d', '$e' , '$g')";

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