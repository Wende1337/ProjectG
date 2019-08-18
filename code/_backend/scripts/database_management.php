<--
Skript um den input und output der Datenbank zu regeln
-->


<?php

    /*
        Database connection with PDO
    */

    $servername = "192.168.0.235";
    $username = "root";
    $password = "test";
    try
    {
        //Create Connection object
        $conn = new PDO("mysql:host=$servername;dbname=test_work_greek");
        //Set the PDO error mode to exception if something goes wrong
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<h1>Connected sucessfully</h1>";
    }
    catch(PDOException $e)
    {
        echo "<h1 color='red'>Connection failed!</h1>";
    }

    //Close the connection
    $conn = null;