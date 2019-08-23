<?php
/*
 * Skript um den input und output der Datenbank zu regeln
 */

    /*
        Database connection with PDO
    */

    $servername = "172.18.0.2"; //ip adress from the container directly not over the bridgeŝ
    $username = "worker";
    $password = "test";

    try
    {
        //Create Connection object
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=projectG_db;charset=utf8mb4", $username, $password);
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

        function insertAufgabe( $lektion_arg, $uebungstitel_arg, $beschreibung_arg, $auswahlmoeglichkeiten_arg, $am_reihenfolge_relevanz_arg, $loesung_arg,
                               $loesung_reihenfolge_relevanz_arg, $max_punkte_arg, $schwierigkeitsgrad_arg, $schlagworte_arg) {
            global $conn;
            $sql = "insert into Aufgabe( lektion, uebungstitel, beschreibung, auswahlmoeglichkeiten, am_reihenfolge_relevanz, 
                    loesung, loesung_reihenfolge_relevanz, max_punkte, schwierigkeitsgrad, schlagworte) 
                    VALUES($lektion_arg, $uebungstitel_arg, $beschreibung_arg, $auswahlmoeglichkeiten_arg, $am_reihenfolge_relevanz_arg, $loesung_arg,
                    $loesung_reihenfolge_relevanz_arg, $max_punkte_arg, $schwierigkeitsgrad_arg, $schlagworte_arg)";

            $conn->exec($sql);

        }

        function insertA1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                         $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into A1 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "A1 Aufgabe erfolgreich eingefügt";
        }
        function insertA2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                          $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into A2 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "A2 Aufgabe erfolgreich eingefügt";

        }
        function insertA3($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                          $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into A3 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "A3 Aufgabe erfolgreich eingefügt";

        }

        function deleteAufgabe( $id ) {
            global $conn;
            $sql = "DELETE FROM Aufgabe WHERE Aufgabe.id_aufgabe = $id";
            $conn->exec($sql);
        }

        function deleteSpecificAufgabe( $id, $type ) {
            global $conn;
            $sql = "DELETE FROM $type WHERE $type.id_aufgabe = $id";
            $conn->exec($sql);

            deleteAufgabe( $id );
            echo "$type Aufgabe erfolgreich gelöscht";
        }
