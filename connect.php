<?php

require_once 'classes/request.php';

$request = new request();
$request->connect = new mysqli("localhost","root","1525","test"); //подключение к серверу
if (!$request->connect){
    die('Ошибка');
}

?>