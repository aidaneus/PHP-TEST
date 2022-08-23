<?php

class addUsers
{
    public $res;
    public $users;
    public $groups;

    public function add_user($users, $groups, $connect, $add)
    {
        $query = mysqli_query($connect,"SELECT name_group,user_id 
                                        FROM groups_n_users 
                                        WHERE name_group='$groups' 
                                        AND user_id=$users
                                        GROUP BY name_group,user_id");                 // запрос имени группы и пользователя
        if (mysqli_num_rows($query) === 0) {                                            // есть ли пользователь пользователь в группе
            if ($connect->query("INSERT groups_n_users(name_group, user_id) 
                                VALUES('$groups','$users')") == TRUE) {                // если нет, то добавляется
                $ret = '{"status": "success"}';
            } else {
                $ret = '{"status": "fail"}';                                           // если есть, то выводится ошибка
            }
        } else {
            $ret = '{"status": "fail"}';
        }
        $add->rights($groups, $connect, "send_messages",$users);
        $add->rights($groups, $connect, "service_api",$users);
        $add->rights($groups, $connect, "debug",$users);
        return ($ret);
    }

    function rights($groups, $connect, $req, $user)
    {
        $res = mysqli_query($connect, "SELECT $req FROM groups WHERE name='$groups'");           // право из группы
        $arr = mysqli_fetch_array($res);
        $res = mysqli_query($connect, "SELECT $req FROM users WHERE user_id=$user");             // право у юзера
        $arr2 = mysqli_fetch_array($res);
        if ($arr[$req] == 'true' && $arr2[$req] != 'block') {                          // если право из гуппы по приоритетности больше, чему у юзера
            $connect->query("UPDATE users SET $req='true' WHERE user_id=$user");       // то апдейтим новое право
        }
        elseif ($arr[$req] == 'block') {
            $connect->query("UPDATE users SET $req='block' WHERE user_id=$user");
        }
        mysqli_free_result($res);
    }
}

?>