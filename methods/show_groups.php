<?php

class showGroups{

    function show_groups($connect){
            $res = mysqli_query($connect, 
                                "SELECT name FROM groups;");
            $rows = array();
            $i = 0;
            while ($rows = mysqli_fetch_array($res)){
                    $r = array();
                    $users = mysqli_query($connect, 
                                    "select user_id from groups_n_users where name_group='$rows[name]';");
                    while ($tmp = mysqli_fetch_array($users))
                        array_push($r,$tmp);
                    foreach($rows as $num)
                        $rows['user_id'] = $r;
                    $result[$i] = $rows;
                    $i++;
                }
                $result = json_encode($result);
                return ($result);
            }
                
    }
?>