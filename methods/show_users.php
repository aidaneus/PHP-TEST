<?php

class showUsers{

    public $rights = ['send_messages','service_api','debug'];
    function show_users($connect){
        $res = mysqli_query($connect, 
                            "SELECT user_id FROM users;");
        $rows = array();
        $i = 0;
        $rights = ['send_messages','service_api','debug'];
        while ($rows = mysqli_fetch_array($res)){
                $r = array();
                $users = mysqli_query($connect, 
                                "select send_messages, service_api, debug from users where user_id='$rows[user_id]';");
                while ($tmp = mysqli_fetch_array($users))
                    array_push($r,$tmp);
                foreach($rows as $num)
                    $rows['rights'] = $r;
                $result[$i] = $rows;
                $i++;
            }
            $result = json_encode($result);
            return ($result);
        }
            
}
?>