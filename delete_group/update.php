<?php

function rights($lol, $connect, $req, $user){                            //обновление прав пользователю
    if ($lol == 0)
        $connect->query("UPDATE users SET $req=0 WHERE user_id=$user;");
    if ($lol == 1)
        $connect->query("UPDATE users SET $req=1 WHERE user_id=$user;");
    if ($lol == 2)
        $connect->query("UPDATE users SET $req=2 WHERE user_id=$user;");
}

?>