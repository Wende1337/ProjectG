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
</body>
</html>

<?php
    require 'database_management.php';

    $table = $_POST['table'];

    if( isset($_POST["table"]) ) {
        switch ( $table ) {
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
    } else {
        $result = getAllA1();
    }


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
        <tr>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
            <td><input type='text' name='id'></td>
        </tr>
    ";
    echo "<table>";
    echo "<input type='submit' name='input' value='Neuen Eintrag einfügen'>";
    //Close the connection
    $conn = null;
?>
<script type="text/javascript">
    window.onload = function() {
        [...document.getElementsByClassName("radio")].forEach(y => y.onclick = "location.reload()");
    }
</script>


