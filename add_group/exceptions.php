<?php

function check($group){
if (empty($_POST['group_name']))
    return 0;
if (ctype_space($group) == true)
    return 0;
return 1;
}
?>