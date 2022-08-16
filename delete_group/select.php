<?php
require_once '../connect.php';
require_once 'update.php';
include 'rights.php';

if (empty($_REQUEST['group'])){                                                               // проверка на пустоту списка групп
  echo "Группа не выбрана";
  echo "<p><a href=http://localhost/PHP-TEST/delete_group/delete_group.php>вернуться назад</a></p>";
  return 1;
}
else
  $group = $_REQUEST['group'];

    if ($request->connect->query("DELETE FROM groups 
                                  WHERE name='$group';") 
                                  === TRUE) {                                                  // удаление группы
        $request->connect->query("DELETE FROM groups_n_users WHERE name_group='$group';");
        echo "Группа удалена!";
        } else {
        echo "Ошибка удаления группы." . $request->connect->error;
        }

$user_num = 1;
while ($user_num <= 3){
      $querry = mysqli_query($request->connect,
                            "SELECT * 
                            FROM groups_n_users 
                            WHERE user_id=$user_num;");                                         // запрос списка групп, в которых есть пользователи
      $flag = 0;

      while($row = mysqli_fetch_array($querry)){
            $flag = 1;
            $query = mysqli_query($request->connect,"SELECT * 
                                                    FROM groups 
                                                    WHERE name='$row[name_group]';");           // запрос прав группы
            while($rows = mysqli_fetch_array($query))
            {
                $i = 0;
                while ($i != 3){
                    set_rights($request,$i,$rows);                                              // проверка прав на приоритетность, относительно
                    $i++;                                                                       // других группЮ в которых есть данный пользователь
                }
            }
            }
            if ($flag == 0){
              $request->send_messages = 0;
              $request->service_api = 0;
              $request->debug = 0;
            }
            // применение прав к пользователям
            rights($request->send_messages, $request->connect, "send_messages",$user_num);
            rights($request->service_api, $request->connect, "service_api",$user_num);
            rights($request->debug, $request->connect, "debug",$user_num);
            $user_num++;
    }

  ?>
  <p><a href="http://localhost/PHP-TEST/delete_group/delete_group.php">вернуться назад</a></p>
  <p><a href="http://localhost/PHP-TEST/">на главную</a></p>