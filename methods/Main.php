<?php

    namespace methods;

    use mysqli;

    class Main
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
            $conn->connect = new mysqli($SERVER, $USER, $PASSWORD, $DB);
        }

        function engine($request, $connect)
        {
            $req = json_decode($request, true);
            switch ($req['command']) {
                case  "add":
                    $add = new AddUser();
                    $res = $add->add_user($req['user_id'], $req['group'], $connect, $add);
                    break;
                case "delete":
                    $delete = new DeleteUser();
                    $res = $delete->delete_user($req['user_id'], $req['group'], $connect, $delete);
                    break;
                case "show_groups":
                    $show = new ShowGroups();
                    $res = $show->show_groups($connect);
                    break;
                case "show_users":
                    $show = new ShowUser();
                    $res = $show->show_users($req['user_id'], $connect);
                    break;
                default:
                    $res = '{"status": "fail"}';
                    break;
            }
            return ($res);
        }
    }