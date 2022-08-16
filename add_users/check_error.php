<?php

function check_error($groups){ //проверка на получение группы
    if ($groups == null)
    {
        echo "Группа не задана";
        return 0;
    }
    return 1;
}
?>