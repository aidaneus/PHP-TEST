<?php
require_once '../connect.php';

function groups($request){
    $res = mysqli_query($request->connect, 
                        "SELECT name FROM groups;");            // список группы

    echo '<select name="groups">';
    echo '<optgroup label="Группы">';
    while ($row = mysqli_fetch_array($res)){
        echo "<option value='$row[name]' >$row[name]</option>"; //вывод групп в список
    }
    echo '</optgroup>';
    echo '</select>';

    mysqli_free_result($res);
}
    ?>