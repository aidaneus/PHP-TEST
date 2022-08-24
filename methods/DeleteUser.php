<?php

    namespace methods;

    class DeleteUser
    {
        public function delete_user($user, $groups, $connect, $delete)
        {
            $check = mysqli_query(
                $connect,
                "SELECT * from groups_n_users WHERE name_group='$groups'AND user_id=$user"
            );
            if (mysqli_num_rows($check) <= 0) {
                return ('{"status": "fail"}');
            }
            if (mysqli_query(
                $connect,
                "DELETE FROM groups_n_users WHERE name_group='$groups' AND user_id=$user;"
            )) {
                $ret = '{"status": "success"}';
            } else {
                $ret = '{"status": "fail"}';
            }
            $delete->change_rights($connect, $user, $delete);
            return ($ret);
        }

        public function change_rights($connect, $user, $delete)
        {
            $right = new AddUser();
            $delete->reset($connect, $user);
            $req = "SELECT * FROM groups_n_users WHERE user_id=$user";
            $query = mysqli_query($connect, $req);
            while ($row = mysqli_fetch_assoc($query)) {
                $res = mysqli_query($connect, "SHOW columns FROM groups");
                $flag = 0;
                while ($arr = mysqli_fetch_array($res)) {
                    if ($flag > 1) {
                        $right->rights($row['name_group'], $connect, $arr[0], $user);
                    }
                    $flag++;
                }
            }
        }

        function reset($connect, $user)
        {
            $res = mysqli_query($connect, "SHOW columns FROM users");
            $flag = 0;
            while ($req = mysqli_fetch_array($res)) {
                if ($flag > 0) {
                    $connect->query("UPDATE users SET $req[0]='false' WHERE user_id=$user");
                }
                $flag++;
            }
        }
    }