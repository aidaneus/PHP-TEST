<?php

    namespace methods;

    class ShowGroups
    {
        public function show_groups($connect)
        {
            $res = mysqli_query($connect, "SELECT name FROM groups");
            $i = 0;
            $result = null;
            while ($rows = mysqli_fetch_assoc($res)) {
                $r = array();
                $users = mysqli_query(
                    $connect,
                    "SELECT user_id FROM groups_n_users WHERE name_group='$rows[name]'"
                );
                while ($tmp = mysqli_fetch_assoc($users)) {
                    $r[] = $tmp;
                }
                foreach ($rows as $ignored) {
                    $rows['user_id'] = $r;
                }
                $result[$i] = $rows;
                $i++;
            }
            $result = json_encode($result);
            return ($result);
        }
    }