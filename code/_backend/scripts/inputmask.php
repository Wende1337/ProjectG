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
</form>


<?php
    require 'database_management.php';

    if( isset($_POST['delete']) ) {
        deleteA1( $_POST['deleteVal'] );
    }

    if ( isset($_POST['input']) ) {
        insertA1($_POST['lektion'], "'".$_POST['uebungstitel']."'", "'".$_POST['beschreibung']."'", "'".$_POST['auswahlmoeglichkeiten']."'",
            $_POST['am_reihenfolge_relevanz'] ,
             "'".$_POST['loesung']."'",
            $_POST['loesung_reihenfolge_relevanz'] ,
            $_POST['max_punkte'], $_POST['schwierigkeitsgrad'], "'".$_POST['schlagworte']."'");
    }

    $table = (isset($_POST['table'])) ? $_POST['table'] : "a1";
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
                    <th> id </th>
                    <th> lektion </th>
                    <th> uebungstitel </th>
                    <th> beschreibung</th>
                    <th> auswahlmoeglichkeiten </th>
                    <th> am_reihenfolge_relevanz </th>
                    <th> loesung </th>
                    <th> loesung_reihenfolge_relevanz </th>
                    <th> max_punkte </th>
                    <th> schwierigkeitsgrad </th>
                    <th> schlagworte </th>
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
    <form method=\"POST\" action=\"inputmask.php\">
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


    <input type='submit' name='input' value='einfuegen'> <br>
    <br>
    <input type="text" name="deleteVal">
    <input type="submit" name="delete" value="Löschen" >
</form>
</body>
</html>