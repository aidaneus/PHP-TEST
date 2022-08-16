<?php
require_once '../connect.php';
require_once 'user_rights.php';
require_once 'exceptions.php';
require_once 'block.php';
require_once '../style.html'
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Добавление группы</title>
    </head>
    <body>
    <?php
        $group = $_REQUEST['group_name'];

        if (!check($group)){
            echo "Пустое поле";
            return (1);
        }

        $asd = mysqli_query($request->connect,
                            "SELECT name FROM groups WHERE name ='$group';");

        if (mysqli_num_rows($asd) <= 0){
            if ($request->connect->query("INSERT groups(name, send_messages, service_api, debug) 
                                        VALUES ('$group','$send_messages','$service_api','$debug');") 
                                        === TRUE) {
                echo "Группа создана!";
                } else {
                echo "Ошибка создания группы" . $request->connect->error;
                }
            }
        else
            echo "Имя занято";
            
        $request->connect->close();
?>
    <p><a href="http://localhost/PHP-TEST/">на главную</a></p>
    </body>
</html>
