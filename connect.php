<?php

require_once 'classes/request.php';

$request = new request();
$request->connect = new mysqli("localhost","root","","test"); //host,user,password,database - подключение к серверу
if (!$request->connect){
    die('Ошибка');
}

?>