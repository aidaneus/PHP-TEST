<?php

function check_error($groups){
    if ($groups == null)
    {
        echo "Группа не задана";
        return 0;
    }
    return 1;
}
?>