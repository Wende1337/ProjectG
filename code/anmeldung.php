<?php

$servername = "localhost";
$user = "db_admin";
$password  = "greekApp12345";

$username = $_POST['username'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=test",$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $conn->query("select * from user;");
    while ($row = $stmt->fetch()) {
        echo $row['id']." ".$row['name']."<br />\n";
    }
}
catch(PDOException $e)
{
    echo "connection failed; ". $e->getMessage();
}



//close connection
$conn = null;
