<?php

function set_groups($request){
$res = mysqli_query($request->connect, "SELECT name FROM groups;"); //запрос имен групп

    echo '<select name="group">';
    echo '<option value="0">--Выберите группу--</option>';
    $r = array();
    while ($row = mysqli_fetch_array($res)){                        //заполнение массива именами групп
        array_push($r,$row);
        $options = array($row['name']);
        echo "<option value='$row[name]'>$row[name]</option>";      //вывод списком имен групп
    }
    echo '</select>';
    "<br>";

    mysqli_free_result($res);
    mysqli_close($request->connect);
}
?>