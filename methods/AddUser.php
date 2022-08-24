<?php

    namespace methods;

    class AddUser
    {
        public function add_user($users, $groups, $connect, $add)
        {
            $req = "SELECT name_group,user_id FROM groups_n_users WHERE name_group='$groups' AND user_id=$users GROUP BY name_group,user_id";
            $query = mysqli_query($connect, $req);
            if (mysqli_num_rows($query) === 0) {
                $req = "INSERT groups_n_users(name_group, user_id) VALUES('$groups','$users')";
                if ($connect->query($req)) {
                    $ret = '{"status": "success"}';
                } else {
                    $ret = '{"status": "fail"}';
                }
            } else {
                $ret = '{"status": "fail"}';
            }
            $res = mysqli_query($connect, "SHOW columns FROM groups");
            $flag = 0;
            while ($arr = mysqli_fetch_array($res)) {
                if ($flag > 1) {
                    $add->rights($groups, $connect, $arr[0], $users);
                }
                $flag++;
            }
            return ($ret);
        }

        function rights($groups, $connect, $req, $user)
        {
            $res = mysqli_query($connect, "SELECT $req FROM groups WHERE name='$groups'");
            $arr = mysqli_fetch_array($res);
            $res = mysqli_query($connect, "SELECT $req FROM users WHERE user_id=$user");
            $arr2 = mysqli_fetch_array($res);
            if ($arr[$req] == 'true' && $arr2[$req] != 'block') {
                $connect->query("UPDATE users SET $req='true' WHERE user_id=$user");
            } elseif ($arr[$req] == 'block') {
                $connect->query("UPDATE users SET $req='block' WHERE user_id=$user");
            }
            mysqli_free_result($res);
        }
    }