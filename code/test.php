<?php

$servername = "localhost";
$username = "db_admin";
$password  = "greekApp12345";


try {
	$conn = new PDO("mysql:host=$servername;dbname=test",$username,$password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connection successfully!";
}
catch(PDOException $e)
	 {
	echo "connection failed; ". $e->getMessage();
}



//close connection
$conn = null;
