<?php
require_once '../connect.php';
//список пользователей
echo "<p><b>Выберите  пользователя:</b><br>";
echo "<br>";
if (isset($_POST['name']) && !empty($_POST['name'])){
    $name = ($_POST['name']);
    $querry = mysqli_query($request->connect, 
                        "SELECT * FROM groups_n_users WHERE name_group='$name';");
    if (mysqli_num_rows($querry) == 0){//проверка на наличие пользователя в группе
        echo "<select name='users' disabled><option value= '1'>--Выберите пользователя--</option></select>"; 
        return 0;
    }
    echo "<select name='users'>";
    while($row = mysqli_fetch_array($querry)){//доступ к пользователям из списка
        echo "<option value='$row[user_id]'>$row[user_id]</option>"; 
    }
    echo "</select>";
}else
    echo "<select name='users' disabled><option value= '0'>--Выберите пользователя--</option></select>";  
?>