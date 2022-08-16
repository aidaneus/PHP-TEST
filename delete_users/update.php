<?php
//изменение прав
function update($num, $connect, $req, $user){
    if ($num == 0)
        $connect->query("UPDATE users SET $req=0 WHERE user_id=$user;");
    if ($num == 1)
        $connect->query("UPDATE users SET $req=1 WHERE user_id=$user;");
    if ($num == 2)
        $connect->query("UPDATE users SET $req=2 WHERE user_id=$user;");
}
?>