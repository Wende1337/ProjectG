<?php
/*
 * Skript um den input und output der Datenbank zu regeln
 */

    /*
        Database connection with PDO
    */

    $servername = "172.18.0.3"; //ip adress from the container directly not over the bridgeŝ
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
        //get all data from Type(T) X
        function getAllTX($type) {
            global $conn;
            global $stmt;
            $stmt = $conn->prepare("select * from Aufgabe inner join ".$type);
            $stmt->execute();

            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $result;
        }

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

            echo $sql;
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
                          $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                          $loesungsvorgabe, $ueberschrift_tabelle1, $ueberschrift_tabelle2, $ueberschrift_tabelle3, $auswahlmoeglichkeiten1,
                          $auswahlmoeglichkeiten2, $auswahlmoeglichkeiten3) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into A3 (id_aufgabe,loesungsvorgabe,ueberschrift_tabelle1,ueberschrift_tabelle2,ueberschrift_tabelle3,
            auswahlmoeglichkeiten1,auswahlmoeglichkeiten2, auswahlmoeglichkeiten3)
            VALUES ((select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1),$loesungsvorgabe, $ueberschrift_tabelle1,
            $ueberschrift_tabelle2, $ueberschrift_tabelle3, $auswahlmoeglichkeiten1,$auswahlmoeglichkeiten2, $auswahlmoeglichkeiten3)";

            $conn->exec($sql);

            echo "A3 Aufgabe erfolgreich eingefügt";

        }

        function insertA4($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                  $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into A4 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "A4 Aufgabe erfolgreich eingefügt";

        }

        function insertB1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                          $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into B1 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "B1 Aufgabe erfolgreich eingefügt";
        }

        function insertB2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesungsvorgabe ,$loesung,
                                                  $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
             global $conn;

             insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

             $sql = "insert into B2 (id_aufgabe,loesungsvorgabe) VALUES ((select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1), $loesungsvorgabe)";
             $conn->exec($sql);

             echo "B2 Aufgabe erfolgreich eingefügt";
        }

        function insertB3($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                  $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
             global $conn;

             insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

             $sql = "insert into B3 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
             $conn->exec($sql);

             echo "B3 Aufgabe erfolgreich eingefügt";
        }
        function insertB4($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                            $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                            $loesungsvorgabe1, $loesungsvorgabe2) {

            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into B4 (id_aufgabe,loesungsvorgabe1,loesungsvorgabe2)  VALUES ((select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1),
                    $loesungsvorgabe1,$loesungsvorgabe2)";
            $conn->exec($sql);

            echo "B4 Aufgabe erfolgreich eingefügt";
        }

        function insertC1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                            $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                            $loesungsvorgabe_spalte1,$loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,$loesungsvorgabe_spalte2_reihenfolge ) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into C1 (id_aufgabe,loesungsvorgabe_spalte1,loesungsvorgabe_spalte1_reihenfolge,
             loesungsvorgabe_spalte2,loesungsvorgabe_spalte2_reihenfolge)
             VALUES ((select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1) ,$loesungsvorgabe_spalte1,
             $loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,$loesungsvorgabe_spalte2_reihenfolge)";

            $conn->exec($sql);

            echo "C1 Aufgabe erfolgreich eingefügt";
        }

        function insertC2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                    $loesungsvorgabe_spalte1,$loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,
                                    $loesungsvorgabe_spalte2_reihenfolge,$loesung_spalte1,$loesung_spalte1_reihenfolge,$loesung_spalte2,
                                     $loesung_spalte2_reihenfolge) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

             $sql = "insert into C2 (id_aufgabe,loesungsvorgabe_spalte1,loesungsvorgabe_spalte1_reihenfolge,
             loesungsvorgabe_spalte2,loesungsvorgabe_spalte2_reihenfolge,loesungsvorgabe_spalte2_reihenfolge,loesung_spalte1,loesung_spalte1_reihenfolge,
             loesung_spalte2,loesung_spalte2_reihenfolge)
             VALUES ((select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1) ,$loesungsvorgabe_spalte1,
             $loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,$loesungsvorgabe_spalte2_reihenfolge,$loesung_spalte1,$loesung_spalte1_reihenfolge,
             $loesung_spalte2,$loesung_spalte2_reihenfolge)";

            $conn->exec($sql);

            echo "C2 Aufgabe erfolgreich eingefügt";
        }

        function insertC3($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                    $loesungsvorgabe_spalte1,$loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,
                                    $loesungsvorgabe_spalte2_reihenfolge, $tabellenvorgabe_spalte3, $tabellenvorgabe_spalte3_reihenfolge,
                                    $loesung1, $loesung2, $loesung3 ) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into C3 (id_aufgabe,loesungsvorgabe_spalte1,loesungsvorgabe_spalte1_reihenfolge,
             loesungsvorgabe_spalte2,loesungsvorgabe_spalte2_reihenfolge,tabellenvorgabe_spalte3, tabellenvorgabe_spalte3_reihenfolge,
             loesung1, loesung2, loesung3 )
             VALUES ((select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1) ,$loesungsvorgabe_spalte1,
             $loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,$loesungsvorgabe_spalte2_reihenfolge,$tabellenvorgabe_spalte3,
             $tabellenvorgabe_spalte3_reihenfolge,$loesung1, $loesung2, $loesung3)";

            $conn->exec($sql);

            echo "C3 Aufgabe erfolgreich eingefügt";
                }

         function insertC4($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                     $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                     $ueberschrift_tabelle_spalte1,$ueberschrift_tabelle_spalte2,$loesung_spalte1,
                                     $loesung_spalte1_reihenfolge, $loesung_spalte2, $loesung_spalte2_reihenfolge
                                      ) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into C4 (id_aufgabe,loesungsvorgabe_spalte1,loesungsvorgabe_spalte1_reihenfolge,
             loesungsvorgabe_spalte2,loesungsvorgabe_spalte2_reihenfolge,
             ueberschrift_tabelle_spalte1,ueberschrift_tabelle_spalte2,loesung_spalte1,loesung_spalte1_reihenfolge,
             loesung_spalte2, loesung_spalte2_reihenfolge)
             VALUES ((select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1) ,$ueberschrift_tabelle_spalte1,
             $ueberschrift_tabelle_spalte2,$loesung_spalte1,$loesung_spalte1_reihenfolge, $loesung_spalte2, $loesung_spalte2_reihenfolge)";

            $conn->exec($sql);

            echo "C4 Aufgabe erfolgreich eingefügt";
         }

         function insertD1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                           $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;
            $loesung_reihenfolge_relevanz = 'NULL';

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into D1 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "D1 Aufgabe erfolgreich eingefügt";

         }

         function insertD2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into D2 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "D2 Aufgabe erfolgreich eingefügt";

         }

         function insertD3($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into D3 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "D3 Aufgabe erfolgreich eingefügt";

         }

        function insertD4($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                   $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into D4 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "D4 Aufgabe erfolgreich eingefügt";

         }

         function insertD5($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into D5 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "D5 Aufgabe erfolgreich eingefügt";

         }

          function insertD6($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                     $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into D6 (id_aufgabe) (select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1)";
            $conn->exec($sql);

            echo "D6 Aufgabe erfolgreich eingefügt";

          }

        function insertE($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                            $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                            $loesungspaare,$loesungspaare_reihenfolge) {
            global $conn;

            insertAufgabe($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);

            $sql = "insert into E (id_aufgabe,loesungspaare,loesungspaare_reihenfolge) VALUES
                ((select Aufgabe.id_aufgabe from Aufgabe ORDER BY id_aufgabe DESC LIMIT 1),$loesungspaare,$loesungspaare_reihenfolge)";
            $conn->exec($sql);

            echo "E Aufgabe erfolgreich eingefügt";

        }

        function insertE1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                    $loesungspaare,$loesungspaare_reihenfolge) {
            global $conn;

            insertE($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                 $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte, $loesungspaare,$loesungspaare_reihenfolge);

            $sql = "insert into E1 (id_e)
                (select E.id_e from E ORDER BY id_e DESC LIMIT 1)";
            $conn->exec($sql);

            echo "E1 Aufgabe erfolgreich eingefügt";

        }

        function insertE2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                            $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                            $loesungspaare,$loesungspaare_reihenfolge,
                                            $auswahlmoeglichkeiten1,$auswahlmoeglichkeiten1_reihenfolge,$auswahlmoeglichkeiten2,
                                            $auswahlmoeglichkeiten2_reihenfolge) {
                    global $conn;

                    insertE($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                         $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte, $loesungspaare,$loesungspaare_reihenfolge);

                    $sql = "insert into E2 (id_e,auswahlmoeglichkeiten1,auswahlmoeglichkeiten1_reihenfolge,auswahlmoeglichkeiten2,auswahlmoeglichkeiten2_reihenfolge)
                        VALUES ((select E.id_e from E ORDER BY id_e DESC LIMIT 1),$auswahlmoeglichkeiten1,$auswahlmoeglichkeiten1_reihenfolge,$auswahlmoeglichkeiten2,
                        $auswahlmoeglichkeiten2_reihenfolge)";
                    $conn->exec($sql);

                    echo "E2 Aufgabe erfolgreich eingefügt";

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
