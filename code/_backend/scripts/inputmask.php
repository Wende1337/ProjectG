<html>
<html>
<meta charset="UTF-8">

<style>
    #tab_content, th, td{
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td{
        padding: 5px;
        text-align: left;
    }
</style>

</html>
<body>
<form method="POST" action="inputmask.php">
    <input type="submit" name="table" value="a1" class="radio">
    <input type="submit" name="table" value="a2" class="radio">
    <input type="submit" name="table" value="a3" class="radio"> <br>


<?php
    require 'database_management.php';



    if( isset($_POST['delete']) ) {
        deleteSpecificAufgabe( $_POST['deleteVal'], "A1" );
    }
    $table = (isset($_POST['table'])) ? $_POST['table'] : "a1";

    if ( isset($_POST['input']) ) {
        $table_d = (isset($_POST['table_destination'])) ? $_POST['table_destination'] : "";

        //Beginning of variable definiton section
        //Variables for the table Aufgabe
        $lektion = ((isset($_POST['lektion'])) ? $_POST['lektion'] : "");
        $uebungstitel = "'".((isset($_POST['uebungstitel'])) ? $_POST['uebungstitel'] : "")."'";
        $beschreibung = "'".((isset($_POST['beschreibung'])) ? $_POST['beschreibung'] : "")."'";
        $auswahlmoeglichkeiten = "'".((isset($_POST['auswahlmoeglichkeiten'])) ? $_POST['auswahlmoeglichkeiten'] : "")."'";
        $am_reihenfolge_relevanz = ((isset($_POST['am_reihenfolge_relevanz'])) ? $_POST['am_reihenfolge_relevanz'] : "");
        $loesung = "'".((isset($_POST['loesung'])) ? $_POST['loesung']  : "")."'";
        $loesung_reihenfolge_relevanz = ((isset($_POST['loesung_reihenfolge_relevanz'])) ?$_POST['loesung_reihenfolge_relevanz']  : "");
        $max_punkte = ((isset($_POST['max_punkte'])) ? $_POST['max_punkte']  : "");
        $schwierigkeitsgrad = ((isset($_POST['schwierigkeitsgrad'])) ? $_POST['schwierigkeitsgrad'] : "");
        $schlagworte = "'".((isset($_POST['schlagworte'])) ? $_POST['schlagworte'] : "")."'";
        $loesungsvorgabe = "'".((isset($_POST['loesungsvorgabe'])) ? $_POST['loesungsvorgabe'] : "")."'"; //for B2 too
        //Variables for the table A3
        $ueberschrift_tabelle1 = "'".((isset($_POST['ueberschrift_tabelle1'])) ? $_POST['ueberschrift_tabelle1'] : "")."'";
        $ueberschrift_tabelle2 = "'".((isset($_POST['ueberschrift_tabelle2'])) ? $_POST['ueberschrift_tabelle2'] : "")."'";
        $ueberschrift_tabelle3 = "'".((isset($_POST['ueberschrift_tabelle3'])) ? $_POST['ueberschrift_tabelle3'] : "")."'";
        $auswahlmoeglichkeiten1 = "'".((isset($_POST['auswahlmoeglichkeiten1'])) ? $_POST['auswahlmoeglichkeiten1'] : "")."'";
        $auswahlmoeglichkeiten2 = "'".((isset($_POST['auswahlmoeglichkeiten2'])) ? $_POST['auswahlmoeglichkeiten2'] : "")."'";
        $auswahlmoeglichkeiten3 = "'".((isset($_POST['auswahlmoeglichkeiten3'])) ? $_POST['auswahlmoeglichkeiten3'] : "")."'";

        //Varaibles for table B4
        $loesungsvorgabe1 = "'".((isset($_POST['loesungsvorgabe1'])) ? $_POST['loesungsvorgabe1'] : "")."'";
        $loesungsvorgabe2 = "'".((isset($_POST['loesungsvorgabe2'])) ? $_POST['loesungsvorgabe2'] : "")."'";
        //Variables for the table C1
        $loesungsvorgabe_spalte1 ="'".((isset($_POST['loesungsvorgabe_spalte1'])) ? $_POST['loesungsvorgabe_spalte1'] : "")."'";
        $loesungsvorgabe_spalte1_reihenfolge =((isset($_POST['loesungsvorgabe_spalte1_reihenfolge'])) ? $_POST['loesungsvorgabe_spalte1_reihenfolge'] : "");
        $loesungsvorgabe_spalte2 ="'".((isset($_POST['loesungsvorgabe_spalte2'])) ? $_POST['loesungsvorgabe_spalte2'] : "")."'";
        $loesungsvorgabe_spalte2_reihenfolge =((isset($_POST['loesungsvorgabe_spalte2_reihenfolge'])) ? $_POST['loesungsvorgabe_spalte2_reihenfolge'] : "");
        //Varaibles for the table C2
        $loesungsvorgabe_spalte1_reihenfolge =((isset($_POST['loesungsvorgabe_spalte1_reihenfolge'])) ? $_POST['loesungsvorgabe_spalte1_reihenfolge'] : "");
        $loesungsvorgabe_spalte1 ="'".((isset($_POST['loesungsvorgabe_spalte1'])) ? $_POST['loesungsvorgabe_spalte1'] : "")."'";
        $loesungsvorgabe_spalte2 ="'".((isset($_POST['loesungsvorgabe_spalte2'])) ? $_POST['loesungsvorgabe_spalte2'] : "")."'";
        $loesung_spalte1_reihenfolge =((isset($_POST['loesung_spalte1_reihenfolge'])) ? $_POST['loesung_spalte1_reihenfolge'] : "");
        $loesung_spalte2 ="'".((isset($_POST['loesung_spalte2'])) ? $_POST['loesung_spalte2'] : "")."'";
        $loesungsvorgabe_spalte2_reihenfolge =((isset($_POST['loesungsvorgabe_spalte2_reihenfolge'])) ? $_POST['loesungsvorgabe_spalte2_reihenfolge'] : "");
        $loesung_spalte1 ="'".((isset($_POST['loesung_spalte1'])) ? $_POST['loesung_spalte1'] : "")."'";
        $loesung_spalte2_reihenfolge =((isset($_POST['loesung_spalte2_reihenfolge'])) ? $_POST['loesung_spalte2_reihenfolge'] : "");
        //Variables for the table C3
        $tabellenvorgabe_spalte3 ="'".((isset($_POST['tabellenvorgabe_spalte3'])) ? $_POST['tabellenvorgabe_spalte3'] : "")."'";
        $tabellenvorgabe_spalte3_reihenfolge =((isset($_POST['tabellenvorgabe_spalte3_reihenfolge'])) ? $_POST['tabellenvorgabe_spalte3_reihenfolge'] : "");
        $loesung1 ="'".((isset($_POST['loesung1'])) ? $_POST['loesung1'] : "")."'";
        $loesung2 ="'".((isset($_POST['loesung2'])) ? $_POST['loesung2'] : "")."'";
        $loesung3 ="'".((isset($_POST['loesung3'])) ? $_POST['loesung3'] : "")."'";
        //Variables for the table C4
        $ueberschrift_tabelle_spalte1 ="'".((isset($_POST['ueberschrift_tabelle_spalte1'])) ? $_POST['ueberschrift_tabelle_spalte1'] : "")."'";
        $ueberschrift_tabelle_spalte2 ="'".((isset($_POST['ueberschrift_tabelle_spalte2'])) ? $_POST['ueberschrift_tabelle_spalte2'] : "")."'";
        //Variables for C7
        $tabellenvorgabe1="'".((isset($_POST['tabellenvorgabe1'])) ? $_POST['tabellenvorgabe1'] : "")."'";
        $tv1_reihenfolge="'".((isset($_POST['tv1_reihenfolge'])) ? $_POST['tv1_reihenfolge'] : "")."'";
        $tabellenvorgabe2="'".((isset($_POST['tabellenvorgabe2'])) ? $_POST['tabellenvorgabe2'] : "")."'";
        $tv2_reihenfolge="'".((isset($_POST['tv2_reihenfolge'])) ? $_POST['tv2_reihenfolge'] : "")."'";
        $tabellenvorgabe3="'".((isset($_POST['tabellenvorgabe3'])) ? $_POST['tabellenvorgabe3'] : "")."'";
        $tv3_reihenfolge ="'".((isset($_POST['tv3_reihenfolge'])) ? $_POST['tv3_reihenfolge'] : "")."'";
        //Variables for the table E
        $loesungspaare ="'".((isset($_POST['loesungspaare'])) ? $_POST['loesungspaare'] : "")."'";
        $loesungspaare_reihenfolge =((isset($_POST['loesungspaare_reihenfolge'])) ? $_POST['loesungspaare_reihenfolge'] : "");
        //Varaibles for the table E2
        $auswahlmoeglichkeiten1_reihenfolge =((isset($_POST['auswahlmoeglichkeiten1_reihenfolge'])) ? $_POST['auswahlmoeglichkeiten1_reihenfolge'] : "");
        $auswahlmoeglichkeiten2_reihenfolge =((isset($_POST['auswahlmoeglichkeiten2_reihenfolge'])) ? $_POST['auswahlmoeglichkeiten2_reihenfolge'] : "");
        ///End of variable definiton section

        switch ($table_d) {
            case "a1":
                insertA1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                          $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                 break;
            case "a2":
                insertA2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                          $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "a3":
                insertA3($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                          $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                          $loesungsvorgabe, $ueberschrift_tabelle1, $ueberschrift_tabelle2, $ueberschrift_tabelle3, $auswahlmoeglichkeiten1,
                                          $auswahlmoeglichkeiten2, $auswahlmoeglichkeiten3) ;
                break;
            case "a4":
                insertA4($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                  $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "b1":
                 insertB1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                           $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "b2":
                insertB2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesungsvorgabe ,$loesung,
                                                                  $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte) ;
                break;
            case "b3":
                insertB3($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                                  $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "b4":
                insertB4($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                    $loesungsvorgabe1, $loesungsvorgabe2);
                break;
            case "c1":

                insertC1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                            $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                            $loesungsvorgabe_spalte1,$loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,$loesungsvorgabe_spalte2_reihenfolge );
                break;
            case "c2":

                insertC2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                                    $loesungsvorgabe_spalte1,$loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,
                                                    $loesungsvorgabe_spalte2_reihenfolge,$loesung_spalte1,$loesung_spalte1_reihenfolge,$loesung_spalte2,
                                                     $loesung_spalte2_reihenfolge);
                break;
            case "c3":

                insertC3($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                                    $loesungsvorgabe_spalte1,$loesungsvorgabe_spalte1_reihenfolge, $loesungsvorgabe_spalte2,
                                                    $loesungsvorgabe_spalte2_reihenfolge, $tabellenvorgabe_spalte3, $tabellenvorgabe_spalte3_reihenfolge,
                                                    $loesung1, $loesung2, $loesung3 );
                break;
            case "c4":

                insertC4($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                     $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                                     $ueberschrift_tabelle_spalte1,$ueberschrift_tabelle_spalte2,$loesung_spalte1,
                                                     $loesung_spalte1_reihenfolge, $loesung_spalte2, $loesung_spalte2_reihenfolge);
                break;
            case "c7":
                insertC7($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, 'NULL',
                    0, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                    $tabellenvorgabe1,$tv1_reihenfolge,$tabellenvorgabe2,$tv2_reihenfolge,$tabellenvorgabe3,$tv3_reihenfolge,
                    $loesung1,$loesung2,$loesung3);
                break;
            case "d1":
                insertD1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                           $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "d2":
                insertD2($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "d3":
                insertD3($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "d4":
                insertD4($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                                   $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "d5":
                insertD5($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "d6":
                insertD6($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                                     $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte);
                break;
            case "e1":

                insertE1($lektion, $uebungstitel, $beschreibung, $auswahlmoeglichkeiten, $am_reihenfolge_relevanz, $loesung,
                                                    $loesung_reihenfolge_relevanz, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                                    $loesungspaare,$loesungspaare_reihenfolge);
                break;
            case "e2":
                insertE2($lektion, $uebungstitel, $beschreibung, 'NULL', 0, 'NULL',
                                                            0, $max_punkte, $schwierigkeitsgrad, $schlagworte,
                                                            $loesungspaare,$loesungspaare_reihenfolge,
                                                            $auswahlmoeglichkeiten1,$auswahlmoeglichkeiten1_reihenfolge,$auswahlmoeglichkeiten2,
                                                            $auswahlmoeglichkeiten2_reihenfolge);
                break;
             default:
                echo "Error no insert possible!";
                break;
        }
    }


        switch ($table) {
            case "a1" :
                $result = getAllA1();
                break;
            case "a2" :
                $result = getAllA2();
                break;
            case "a3" :
                $result = getAllA3();
                break;
            default:
                $result = getAllA1();
        }

    echo "<h3 id='response'>$table</h3>";
    echo "<table id='tab_content'>
                <tr>
                    <th> Nr. </th>
                    <th> Lektion </th>
                    <th> Übungstitel </th>
                    <th> Beschreibung</th>
                    <th> Auswahlmöglichkeiten </th>
                    <th> Auswahlmöglichkeiten Reihenfolge relevant? </th>
                    <th> Loesung </th>
                    <th> Loesung Reihenfolge relevant? </th>
                    <th> Punkte </th>
                    <th> Schwierigkeitsgrad </th>
                    <th> Schlagworte </th>
                </tr>
         ";
    foreach( $stmt->fetchAll() as $array=>$row) {
        echo "<tr>";
        foreach ($row as $val=>$columnValue) {
              echo "<td>".$columnValue."</td>";
        }
        echo "</tr>";
    }

    echo "
        <tr>
            <td></td>
            <td><input type='text' name='lektion'></td>
            <td><input type='text' name='uebungstitel'></td>
            <td><input type='text' name='beschreibung'></td>
            <td><input type='text' name='auswahlmoeglichkeiten'></td>
            <td><input type='text' name='am_reihenfolge_relevanz'></td>
            <td><input type='text' name='loesung'></td>
            <td><input type='text' name='loesung_reihenfolge_relevanz'></td>
            <td><input type='text' name='max_punkte'></td>
            <td><input type='text' name='schwierigkeitsgrad'></td>
            <td><input type='text' name='schlagworte'></td>
        </tr>
    ";
    echo "<table>";
    echo "<input type='hidden' name='table_destination' value='".$table."'>";
    //Close the connection
    $conn = null;
?>


    <input type='submit' name='input' value='Einfügen'> <br>
    <br>
    Nr. eingeben: <br>
    <input type="text" name="deleteVal">
    <input type="submit" name="delete" value="Löschen" >

</form>
</body>
</html>