<?php
require_once '../connect.php';
require_once 'update.php';
require_once 'rights.php';
require_once '../style.html';

//получение значений списка
$groups = $_REQUEST['groups'];
if (empty($_REQUEST['users'])){ //проверка пользователя в группе
    echo "Пользователь не выбран";
    echo "<br>";
    echo "<br>";
    echo "<a href=http://localhost/PHP-TEST/delete_users/delete_users.php>вернуться назад</a>";
    return 1;
}
else
    $user = $_REQUEST['users'];

//удаление пользователя
if (mysqli_query($request->connect,
                "DELETE FROM groups_n_users 
                WHERE name_group='$groups' 
                AND user_id=$user;") == TRUE){
    echo "Пользователь удален!";
} else {
    echo "Ошибка удаления пользователя." . $request->connect->error;
    }

//изменение прав
$querry = mysqli_query($request->connect,"SELECT * FROM groups_n_users WHERE user_id=$user;");
while($row = mysqli_fetch_array($querry)){
        $req = mysqli_query($request->connect,
                        "SELECT * FROM groups WHERE name='$row[name_group]';");
        while($rows = mysqli_fetch_array($req))
        {
            $i = 0;
            while ($i != 3){
                rights($rows, $i, $request);//внесение изменений во временные переменные
                $i++;
            }
        }
    }
    // применение прав к user_id
    update($request->send_messages, $request->connect, "send_messages",$user);
    update($request->service_api, $request->connect, "service_api",$user);
    update($request->debug, $request->connect, "debug",$user);

?>
<p><a href="http://localhost/PHP-TEST/delete_users/delete_users.php">вернуться назад</a></p>
<p><a href="http://localhost/PHP-TEST/">на главную</a></p>