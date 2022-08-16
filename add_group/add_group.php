<?php
require_once '../connect.php';
require_once '../style.html'
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Добавление группы</title>
    </head>
    <body>
        <form action = "create_groups.php" method="post">
    <p><b>Группа:</b><br>
        <input type="text" name="group_name" size="20"></p>
    <p><b>Права:</b><br>
    <p><input type="checkbox" name="send_messages"> send_messages</p>
    <p><input type="checkbox" name="service_api"> service_api</p>
    <p><input type="checkbox" name="debug"> debug</p>
    <p><b>Заблокированные права:</b><br>
    <p><input type="checkbox" name="send_messages_block"> send_messages_block</p>
    <p><input type="checkbox" name="service_api_block"> service_api_block</p>
    <p><input type="checkbox" name="debug_block"> debug_block</p>
    <p><input type ="submit" value="Добавить">
    <p><a href="http://localhost/PHP-TEST/">вернуться назад</a></p>
    </body>
</html>