<?php

function groups($request){
  
                                                                                // создание таблицы, прав и имени группы
echo '<table border="2">';
    echo '<tr>';
    echo '<td>Name</td>';
    echo '<td>send_messages</td>';
    echo '<td>service_api</td>';
    echo '<td>debug</td>';
    echo '</tr>';

$res = mysqli_query($request->connect, 
                    "SELECT name FROM groups;");                                // запрос на имена групп
$right = mysqli_query($request->connect, 
                    "SELECT send_messages,service_api,debug FROM groups;");     // запрос на права групп
$rows = array();

while ($tmp = mysqli_fetch_array($right)){                                      // заполняет массив значений прав из групп
          array_push($rows,$tmp);
}

$i = 0;
while ($row = mysqli_fetch_array($res)){                                        // массив имен групп
  $j = 0;
  echo '<tr>';
  echo '<td>',($row['name']),'</td>';                                           // вывод имени группы
  echo '</td>';
  while ($j != 3){
    if ($rows[$i][$request->rights[$j]] == 1 )                                  //проверка значения у группы 
      echo '<td> <h0 style=color:green>',"TRUE",'</td>';                        // вывод значения прав в таблицу
    else if ($rows[$i][$request->rights[$j]] == 2) 
      echo '<td> <h0 style=color:red>',"BLOCK",'</td>';
    else 
      echo '<td> <h0 style=color:blue>',"FALSE",'</td>';
    $j++;
  }
  $i++;
}
echo '</table>';

mysqli_free_result($res);
mysqli_free_result($right);
}
?>