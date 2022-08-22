<?php

class main
{
    public $connect;

    function conn($conn)
    {
        $json = file_get_contents('db.json');
        $row = json_decode($json, true);
        $SERVER = $row['server'];
        $DB = $row['db'];
        $USER = $row['user'];
        $PASSWORD = $row['password'];
        $conn->connect = new mysqli($SERVER,$USER,$PASSWORD,$DB);
        if (!$conn->connect) {
            die('Ошибка');
        }
    }

    function engine($request, $connect)
    {
        $req = json_decode($request, true);
        switch ($req['command']) {
            case  "add":
                $add = new addUsers();
                $res =  $add->add_user($req['user_id'], $req['group'], $connect, $add);
                break;
            case "delete":
                $delete = new deleteUsers();
                $res = $delete->delete_user($req['user_id'], $req['group'], $connect, $delete);
                break;
            case "show_groups":
                $show = new showGroups();
                $res = $show->show_groups($connect, $show);
                break;
            case "show_users":
                $show = new showUsers();
                $res = $show->show_users($connect, $show);
                break;
            default:
                $res = '{"status": "fail"}';
                break;
        }
        return ($res);
    }
}

?>