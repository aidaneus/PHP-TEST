<?php
// проверка прав
if (!$send_messages = isset($_POST['send_messages']))
    $send_messages = 0;
else
    $send_messages = 1;
if (!$service_api = isset($_POST['service_api']))
    $service_api = 0;
else
    $service_api = 1;
if (!$debug = isset($_POST['debug']))
    $debug = 0;
else
    $debug = 1;

?>