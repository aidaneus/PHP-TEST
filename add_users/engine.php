<?php
require_once '../connect.php';
require_once 'add_rights.php';
require_once 'check_error.php';
require_once '../style.html';

if (empty($_REQUEST['groups'])){ //проверка существования группы
    echo "Пользователь не выбран";
    echo "<br>";
    echo "<br>";
    echo "<a href=http://localhost/PHP-TEST/add_users/add_users.php>вернуться назад</a>";
    return 1;
}
else
    $groups = $_REQUEST['groups'];
$users = $_REQUEST['users'];

if (!check_error($groups))
    return (1);

$query = mysqli_query($request->connect,"SELECT name_group,user_id 
                                        FROM groups_n_users 
                                        WHERE name_group='$groups' 
                                        AND user_id=$users
                                        GROUP BY name_group,user_id;");
if (mysqli_num_rows($query) == 0){
    if ($request->connect->query("INSERT groups_n_users(name_group, user_id) 
                                VALUES('$groups','$users');") 
                                === TRUE) {
        echo "Пользователь добавлен!";
        } else {
        echo "Ошибка: пользователь уже добавлен." . $request->connect->error;
        }
} else{
    echo "Пользователь уже добавлен в группу!";
}

rights($groups, $request->connect, "send_messages",$users);
rights($groups, $request->connect, "service_api",$users);
rights($groups, $request->connect, "debug",$users);
?>
<br>
<br>
<a href="http://localhost/PHP-TEST/add_users/add_users.php">вернуться назад</a>
<br>
<br>
<a href="http://localhost/PHP-TEST/">на главную</a>