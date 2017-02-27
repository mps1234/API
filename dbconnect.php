<?php

//Constants for DB connection
require ("constants.php");

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

if(!isset($con))
	{
		die("Database Connection Failed");
	}
?>