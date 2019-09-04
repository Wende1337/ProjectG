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
        switch ($table) {
            case "a1":
                insertA1($_POST['lektion'], "'".$_POST['uebungstitel']."'", "'".$_POST['beschreibung']."'", "'".$_POST['auswahlmoeglichkeiten']."'",
                        $_POST['am_reihenfolge_relevanz'] ,
                         "'".$_POST['loesung']."'",
                        $_POST['loesung_reihenfolge_relevanz'] ,
                        $_POST['max_punkte'], $_POST['schwierigkeitsgrad'], "'".$_POST['schlagworte']."'");
                 break;
            case "a2":
                insertA2($_POST['lektion'], "'".$_POST['uebungstitel']."'", "'".$_POST['beschreibung']."'", "'".$_POST['auswahlmoeglichkeiten']."'",
                                        $_POST['am_reihenfolge_relevanz'] ,
                                         "'".$_POST['loesung']."'",
                                        $_POST['loesung_reihenfolge_relevanz'] ,
                                        $_POST['max_punkte'], $_POST['schwierigkeitsgrad'], "'".$_POST['schlagworte']."'");
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