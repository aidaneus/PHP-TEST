<?php
require_once '../connect.php';
require_once 'engine.php';
require_once '../style.html'
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title>Удаление группы</title>
    </head>
    <body>
        <form action = "select.php" method="post">
        <p><b>Выберите  группу:</b><br>
        <br>
            <?php
                set_groups($request);
            ?>
        <br>
        <p><input type ="submit" value="Удалить">
        <p>
        <a href="http://localhost/PHP-TEST/">вернуться назад</a>
        </p>
    </body>
</html>