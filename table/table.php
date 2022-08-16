<?php
require_once 'table_groups.php';
require_once 'update_groups.php';

function table($request){
  
    echo '<table border="1">';
    echo '<tr>';
    echo '<td></td>';
    echo '<td>ID</td>';
    echo '<td>groups</td>';
    echo '<td>send_messages</td>';
    echo '<td>service_api</td>';
    echo '<td>debug</td>';
    echo '</tr>';
    $res = mysqli_query($request->connect,"SELECT user_id FROM users;");                                // запрос пользователей
    $right = mysqli_query($request->connect,"SELECT send_messages,service_api,debug FROM users;");      // запрос прав пользователей
    $rows = array();
    
    while ($r = mysqli_fetch_assoc($right)){
              array_push($rows,$r);
    }
    
    $i = 0;
    
    while ($row = mysqli_fetch_array($res)){
      $p = 0;
      echo '<tr>';
      echo '<td>',"user_id: ",'</td>';
      echo '<td>',($row['user_id']),'</td>';                                                             // вывод id пользователя
      echo '<td>';
      update_groups($row['user_id'],$request->connect);                                                  // вывод групп, в которых состоит пользователь
      echo '</td>';
      while ($p != 3){                                                                                   // вывод прав пользователя
        if ($rows[$i][$request->rights[$p]] == 1 )
          echo '<td> <ho style=color:green>',"TRUE",'</td>';
        else if ($rows[$i][$request->rights[$p]] == 2) 
          echo '<td> <h0 style=color:red>',"BLOCK",'</td>';
        else 
          echo '<td> <h0 style=color:blue>',"FALSE",'</td>';
        $p++;
      }
      $i++;
    }
    echo '</tr>';
    echo '</table>';
    groups($request);
    
    
    mysqli_free_result($res);
    mysqli_close($request->connect);
    }
    
?>