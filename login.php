<?php 
session_start();
require_once 'conn.php';

if (isset($_POST['login'])) {

$username = $_POST["username"];
$password = $_POST["password"];

$login = "SELECT * FROM `users` WHERE `username` = '$username' && `password` = '$password'";
$result = $conn->query($login);
$row = $result->fetch_assoc();

if ($username = $row['username'] && $password = $row['password'] && $row['type'] == 'Admin') {
	$_SESSION['auth'] = "yes";
	$_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['password'] = $row['password'];
	$_SESSION['firstname'] = $row['first_name'];
	$_SESSION['lastname'] = $row['last_name'];

	header("Location:home.php");
	exit();
	}
else if ($username = $row['username'] && $password = $row['password'] && $row['type'] == 'Secretary') {
	$_SESSION['auth'] = "yes";
	$_SESSION['id'] = $row['id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['password'] = $row['password'];
	$_SESSION['firstname'] = $row['first_name'];
	$_SESSION['lastname'] = $row['last_name'];
	$_SESSION['orgID'] = $row['orgID'];

	header("Location:secretaryHome.php");
	exit();
}
	else {

		header("Location:loginfailed.html");
	}
}