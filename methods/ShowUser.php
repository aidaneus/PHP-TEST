<?php

    namespace methods;

    class ShowUser
    {
        public function show_users($req, $connect)
        {
            $res = mysqli_query($connect, "SELECT * FROM users WHERE user_id=$req");
            $rows = mysqli_fetch_assoc($res);
            $result = json_encode($rows);
            return ($result);
        }
    }