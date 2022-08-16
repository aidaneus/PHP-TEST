<?php
require_once '../connect.php';
require_once 'groups.php';
require_once 'user.php';
require_once '../style.html'
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Добавление пользователя в группу:</title>
    </head>
    <body>
    <form action = "engine.php" method="post">
    <p><b>Выберите  группу:</b><br>
    <?php
            groups($request);
    ?>
    <br>
    <p><b>Выберите  пользователя:</b><br>
    <?php
            user($request);
    ?>
    <br>
        <p><input type ="submit" value="Добавить">
        <br>
        <br>
        <a href="http://localhost/PHP-TEST/">вернуться назад</a>
        </p>
    </body>
</html>