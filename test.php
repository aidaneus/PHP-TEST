<?php

    use PHPUnit\Framework\TestCase;

    require __DIR__ . "/vendor/autoload.php";

    use methods\Main;

    class Test extends TestCase
    {
        public function testAddUserInAGroup()                //проверка на добавление пользователя №2 в группу
        {
            $request = '{
            "command": "add",
            "user_id": 2,
            "group": "test2"
            }';
            $main = new Main();
            $main->conn($main);
            $ret = '{"status": "success"}';
            $this->assertEquals($ret, $main->engine($request, $main->connect));
        }

        public function testRightsAfterAddingUserInGroup()    //проверка смены прав у пользователя №2 и блокировка права
        {
            $main = new Main();
            $main->conn($main);
            $req = mysqli_query(
                $main->connect,
                "SELECT send_messages, service_api, debug FROM groups WHERE name='test2'"
            );
            $row_group = array();
            $row_user = array();
            while ($tmp = mysqli_fetch_array($req)) {
                $row_group[] = $tmp;
            }
            $req = mysqli_query(
                $main->connect,
                "SELECT send_messages, service_api, debug FROM users WHERE user_id=2;"
            );
            while ($tmp = mysqli_fetch_array($req)) {
                $row_user[] = $tmp;
            }
            $this->assertEquals($row_group, $row_user);
        }

        public function testUserInAGroup(
        )                     //проверка на добавление уже существующего в группе пользователя №2
        {
            $request = '{
            "command": "add",
            "user_id": 2,
            "group": "test2"
          }';
            $main = new Main();
            $main->conn($main);
            $ret = '{"status": "fail"}';
            $this->assertEquals($ret, $main->engine($request, $main->connect));
        }

        public function testDeleteUser()                    // проверка на удаление пользователя №2 из группы
        {
            $request = '{
            "command": "delete",
            "user_id": 2,
            "group": "test2"
            }';
            $main = new Main();
            $main->conn($main);
            $ret = '{"status": "success"}';
            $this->assertEquals($ret, $main->engine($request, $main->connect));
        }

        public function testDeleteUserRepeat()               // проверка на повторное удаление пользователя №2 из группы
        {
            $request = '{
            "command": "delete",
            "user_id": 2,
            "group": "test2"
            }';
            $main = new Main();
            $main->conn($main);
            $ret = '{"status": "fail"}';
            $this->assertEquals($ret, $main->engine($request, $main->connect));
        }

        public function testRightsAfterDeleteUserFromGroup(
        )     //проверка смены прав у пользователя №2 после удаления из группы
        {
            $main = new Main();
            $main->conn($main);

            $arr_check = array(
                'send_messages' => 'false',
                'service_api' => 'false',
                'debug' => 'false'
            );
            $req = mysqli_query(
                $main->connect,
                "SELECT send_messages, service_api, debug FROM users WHERE user_id=2"
            );
            $row_user = mysqli_fetch_assoc($req);
            $this->assertEquals($row_user, $arr_check);
        }

        public function testShowGroup()                            //проверка вывода групп вместе с правами
        {
            $request = '{
            "command": "show_groups"
            }';
            $main = new Main();
            $main->conn($main);
            $ret = '[
            {
                "name": "test",
                "user_id": [
                    {
                        "user_id": "1"
                    }
                ]
            },
            {
                "name": "test2",
                "user_id": []
            },
            {
                "name": "test3",
                "user_id": [
                    {
                        "user_id": "3"
                    }
                ]
            }
        ]';
            $ret = str_replace(array("\r", "\n", " "), "", $ret);
            $this->assertEquals($ret, $main->engine($request, $main->connect));
        }

        public function testShowUser()                            //проверка вывода пользователей с правами
        {
            $request = '{
            "command": "show_users",
            "user_id": 2
        }';
            $main = new Main();
            $main->conn($main);
            $ret = '{
            "user_id": "2",
            "send_messages": "false",
            "service_api": "false",
            "debug": "false"
        }';
            $ret = str_replace(array("\r", "\n", " "), "", $ret);
            $this->assertEquals($ret, $main->engine($request, $main->connect));
        }
    }