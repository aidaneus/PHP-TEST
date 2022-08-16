<?php
function rights($groups, $connect, $req, $user){
    $res = mysqli_query($connect, 
                        "SELECT $req FROM groups WHERE name='$groups';");   //право из группы
    $arr = mysqli_fetch_array($res);

    $res = mysqli_query($connect, 
                        "SELECT $req FROM users WHERE user_id=$user;");     // право у юзера
    $arr2 = mysqli_fetch_array($res);
    if ($arr[$req] == 1 && $arr[$req]>$arr2[$req])                          //если право из гуппы по приоритетности больше, чему у юзера
        $connect->query("UPDATE users SET $req=1 WHERE user_id=$user;");    // то апдейтим новое право
    if ($arr[$req] == 2)
        $connect->query("UPDATE users SET $req=2 WHERE user_id=$user;");
    mysqli_free_result($res);
}
?>