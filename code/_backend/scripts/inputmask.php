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
        $lektion_p= ((isset($_POST['lektion'])) ? $_POST['lektion'] : "");
        $uebungstitel_p = "'".((isset($_POST['uebungstitel'])) ? $_POST['uebungstitel'] : "")."'";
        $beschreibung_p = "'".((isset($_POST['beschreibung'])) ? $_POST['beschreibung'] : "")."'";
        $auswahlmoeglichkeiten_p = "'".((isset($_POST['auswahlmoeglichkeiten'])) ? $_POST['auswahlmoeglichkeiten'] : "")."'";
        $am_reihenfolge_relevanz_p = ((isset($_POST['am_reihenfolge_relevanz'])) ? $_POST['am_reihenfolge_relevanz'] : "");
        $loesung_p = "'".((isset($_POST['loesung'])) ? $_POST['$loesung']  : "")."'";
        $loesung_reihenfolge_relevanz_p = ((isset($_POST['loesung_reihenfolge_relevanz'])) ?$_POST['loesung_reihenfolge_relevanz']  : "");
        $max_punkte_p = ((isset($_POST['max_punkte'])) ? $_POST['max_punkte']  : "");
        $schwierigkeitsgrad_p = ((isset($_POST['schwierigkeitsgrad'])) ? $_POST['schwierigkeitsgrad'] : "");
        $schlagworte_p = "'".((isset($_POST['schlagworte'])) ? $_POST['schlagworte'] : "")."'";
        $loesungsvorgabe_p = "'".((isset($_POST['loesungsvorgabe'])) ? $_POST['loesungsvorgabe'] : "")."'";
        $ueberschrift_tabelle1_p = "'".((isset($_POST['ueberschrift_tabelle1'])) ? $_POST['ueberschrift_tabelle1'] : "")."'";
        $ueberschrift_tabelle2_p = "'".((isset($_POST['ueberschrift_tabelle2'])) ? $_POST['ueberschrift_tabelle2'] : "")."'";
        $ueberschrift_tabelle3_p = "'".((isset($_POST['ueberschrift_tabelle3'])) ? $_POST['ueberschrift_tabelle3'] : "")."'";
        $auswahlmoeglichkeiten1_p = "'".((isset($_POST['auswahlmoeglichkeiten1'])) ? $_POST['auswahlmoeglichkeiten1'] : "")."'";
        $auswahlmoeglichkeiten2_p = "'".((isset($_POST['auswahlmoeglichkeiten2'])) ? $_POST['auswahlmoeglichkeiten2'] : "")."'";
        $auswahlmoeglichkeiten3_p = "'".((isset($_POST['auswahlmoeglichkeiten3'])) ? $_POST['auswahlmoeglichkeiten3'] : "")."'";
        ///End of variable definiton section

        switch ($table_d) {
            case "a1":
                insertA1($lektion_p, $uebungstitel_p, $beschreibung_p, $auswahlmoeglichkeiten_p, $am_reihenfolge_relevanz_p, $loesung_p,
                    $loesung_reihenfolge_relevanz_p, $max_punkte_p, $schwierigkeitsgrad_p, $schlagworte_p);
                 break;
            case "a2":
                insertA2($lektion_p, $uebungstitel_p, $beschreibung_p, $auswahlmoeglichkeiten_p, $am_reihenfolge_relevanz_p, $loesung_p,
                    $loesung_reihenfolge_relevanz_p, $max_punkte_p, $schwierigkeitsgrad_p, $schlagworte_p);
                break;
            case "a3":
                insertA3($lektion_p, $uebungstitel_p, $beschreibung_p, $auswahlmoeglichkeiten_p, $am_reihenfolge_relevanz_p, $loesung_p,
                    $loesung_reihenfolge_relevanz_p, $max_punkte_p, $schwierigkeitsgrad_p, $schlagworte_p,
                                          $loesungsvorgabe_p, $ueberschrift_tabelle1_p, $ueberschrift_tabelle2_p, $ueberschrift_tabelle3_p, $auswahlmoeglichkeiten1_p,
                                          $auswahlmoeglichkeiten2_p, $auswahlmoeglichkeiten3_p);
                break;
            case "a4":

                break;
            case "b1":

                break;
            case "b2":

                break;
            case "b3":

                break;
            case "c1":

                break;
            case "c2":

                break;
            case "c3":

                break;
            case "c4":

                break;
            case "d1":

                break;
            case "d2":

                break;
            case "d3":

                break;
            case "d4":

                break;
            case "d5":

                break;
            case "d6":

                break;
            case "e1":

                break;
            case "e2":

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

    echo "<h3>$table</h3>";
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