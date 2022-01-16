<?php
	session_start();
	session_unset('id');
	header('location:index.php');