<?php
require_once '../connect.php';

function user($request){
    $res = mysqli_query($request->connect, 
                        "SELECT user_id FROM users;");
    echo '<select name="users">';
    echo '<optgroup label="Пользователи">';
    while ($row = mysqli_fetch_array($res)){
        echo "<option value='$row[user_id]' >$row[user_id]</option>";
    }
        echo '</optgroup>';
        echo '</select>';
        mysqli_free_result($res);
        mysqli_close($request->connect);
}
    ?>