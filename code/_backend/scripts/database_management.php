<--
Skript um den input und output der Datenbank zu regeln
-->

<html>
    <head>
        <meta charset="UTF-8">
    </head>
</html>
<?php

    /*
        Database connection with PDO
    */

    $servername = "172.18.0.2"; //ip adress from the container directly not over the bridgeŝ
    $username = "root";
    $password = "test";
    try
    {
        //Create Connection object
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=test_work_greek;charset=utf8mb4", $username, $password);
        //Set the PDO error mode to exception if something goes wrong
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<h1>Connected sucessfully</h1>";

        $stmt = $conn->prepare("select id_aufgabe,lektion,uebungstitel,beschreibung,auswahlmoeglichkeiten,am_reihenfolge_relevanz,loesung,loesung_reihenfolge_relevanz,
                                            max_punkte,schwierigkeitsgrad,schlagworte from Aufgabe");
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        echo "<table id='tab_content'>";
        foreach( $stmt->fetchAll() as $array=>$row) {
            echo "<tr>";
            foreach ($row as $val=>$columnValue) {
                echo "<th>".$columnValue."</th>";
            }
            echo "</tr>";
        }
        echo "<table>";
    }
    catch(PDOException $e)
    {
        echo "<h1 color='red'>Connection failed!</h1>";
    }

    //Close the connection
    $conn = null;