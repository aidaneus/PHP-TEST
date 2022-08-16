<?php
//проверки прав на блокировку
if (!$send_messages_block = isset($_POST['send_messages_block']))
    $send_messages_block = 0;
else
    $send_messages_block = 2;
if (!$service_api_block = isset($_POST['service_api_block']))
    $service_api_block = 0;
else
    $service_api_block = 2;
if (!$debug_block = isset($_POST['debug_block']))
    $debug_block = 0;
else
    $debug_block = 2;

if ($send_messages_block > $send_messages)
    $send_messages = 2;
if ($service_api_block > $service_api)
    $service_api = 2;
if ($debug_block > $debug)
    $debug = 2;
?>