<?php

function update_groups($user_id, $connect){
$request = "SELECT name_group FROM groups_n_users WHERE user_id=$user_id;";
$query = mysqli_query($connect, $request);
$rows = array();
while ($r = mysqli_fetch_assoc($query)){
    array_push($rows,$r);
}
$lol = mysqli_num_rows($query);
$i = 0;
while($lol > 0){
    foreach($rows[$i] as $mem){
        echo $mem . "<br>";
        $i++;
    }
    $lol--;
    }
}

?>