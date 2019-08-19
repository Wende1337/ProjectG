<?php
/*
 * Skript um den input und output der Datenbank zu regeln
 */

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
    }
    catch(PDOException $e)
    {
        echo "Connection failed!".$e->getMessage();
        //Close the connection
        $conn = null;
    }

    //Functions for the db communication as interface
        function getAllA1() {
            global $conn;
            global $stmt;
            $stmt = $conn->prepare("select Aufgabe.id_aufgabe,lektion,uebungstitel,beschreibung,auswahlmoeglichkeiten,am_reihenfolge_relevanz,loesung,loesung_reihenfolge_relevanz,
                                            max_punkte,schwierigkeitsgrad,schlagworte from Aufgabe inner join A1 on A1.id_aufgabe = Aufgabe.id_aufgabe");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $result;
        }
        function getAllA2() {
            global $conn;
            global $stmt;
            $stmt = $conn->prepare("select Aufgabe.id_aufgabe,lektion,uebungstitel,beschreibung,auswahlmoeglichkeiten,am_reihenfolge_relevanz,loesung,loesung_reihenfolge_relevanz,
                                            max_punkte,schwierigkeitsgrad,schlagworte from Aufgabe inner join A2 on A2.id_aufgabe = Aufgabe.id_aufgabe");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $result;
        }
        function getAllA3() {
            global $conn;
            global $stmt;
            $stmt = $conn->prepare("select Aufgabe.id_aufgabe,lektion,uebungstitel,beschreibung,auswahlmoeglichkeiten,am_reihenfolge_relevanz,loesung,loesung_reihenfolge_relevanz,
                                            max_punkte,schwierigkeitsgrad,schlagworte from Aufgabe inner join A3 on A3.id_aufgabe = Aufgabe.id_aufgabe");
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $result;
        }

        function inputAufgabe( $lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                               $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;
            global $stmt;
            $stmt = "insert into Aufgabe( lektion, uebungstitel, beschreibung, auswahlmoeglichkeiten, am_reihenfolge_relevanz, 
                    loesung, loesung_reihenfolge_relevanz, max_punkte, schwierigkeitsgrad, schlagworte) 
                    VALUES($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte)";
            $conn->exec($stmt);

        }

        function inputA1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                         $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {

            inputAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            echo "<script> window.alert(\"Aufgabe successful inserted\"); </script>";
        }
        function inputA2() {

        }
        function inputA3() {

        }

