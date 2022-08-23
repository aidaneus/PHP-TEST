<?php

class deleteUsers
{
    public $send_messages = 'false';
    public $service_api = 'false';
    public $debug = 'false';
    public $rights = ['send_messages','service_api','debug'];
    
    public function delete_user($user, $groups, $connect, $delete)
    {
        $check = mysqli_query($connect, "SELECT * from groups_n_users 
                                        WHERE name_group='$groups'AND user_id=$user");
        if (mysqli_num_rows($check) <= 0) {                                           //проверка на существование пользователя в группе
            return($ret = '{"status": "fail"}');
        }
        if (mysqli_query($connect,
            "DELETE FROM groups_n_users 
            WHERE name_group='$groups' 
            AND user_id=$user;") == TRUE) {
            $ret = '{"status": "success"}';
        } else {
            $ret = '{"status": "fail"}';
        }
        $delete->change_rights($connect,$user,$delete);
        return ($ret);
    }

    public function change_rights($connect,$user,$delete)
    {
        $querry = mysqli_query($connect,"SELECT * FROM groups_n_users WHERE user_id=$user;");
        while($row = mysqli_fetch_array($querry)) {
        $req = mysqli_query($connect,
                        "SELECT * FROM groups WHERE name='$row[name_group]';");
            while($rows = mysqli_fetch_array($req)) {
                $i = 0;
                while ($i != 3) {
                    $delete->check_right($rows, $i, $delete);//внесение изменений во временные переменные
                    $i++;
                }
            }
        }
        // применение прав к user_id
        $delete->update($delete->send_messages, $connect, "send_messages",$user);
        $delete->update($delete->service_api, $connect, "service_api",$user);
        $delete->update($delete->debug, $connect, "debug",$user);
    }

    public function check_right($rows, $i, $delete)
    {
        if ($delete->rights[$i] === 'send_messages' 
            && $rows[$delete->rights[$i]] != $delete->send_messages 
            && $delete->send_messages != 'block') {
            $delete->send_messages = $rows[$delete->rights[$i]];
        }
        elseif ($delete->rights[$i] === 'service_api' 
            && $rows[$delete->rights[$i]] != $delete->service_api 
            && $delete->service_api != 'block') {
            $delete->service_api = $rows[$delete->rights[$i]];
        }
        elseif ($delete->rights[$i] === 'debug' 
            && $rows[$delete->rights[$i]] != $delete->debug 
            && $delete->debug != 'block') {
            $delete->debug = $rows[$delete->rights[$i]];
        }
    }

    public function update($req,$connect,$num,$user)
    {
        if ($req == 'false') {
            $connect->query("UPDATE users SET $num='false' WHERE user_id=$user;");
        }
        elseif ($req == 'true') {
            $connect->query("UPDATE users SET $num='true' WHERE user_id=$user;");
        }
        elseif ($req == 'block') {
            $connect->query("UPDATE users SET $num='block' WHERE user_id=$user;");
        }
    }
}


?>