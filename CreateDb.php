<?php

    $json = file_get_contents('db.json');
    $row = json_decode($json, true);
    $SERVER = $row['server'];
    $DB = $row['db'];
    $USER = $row['user'];
    $PASSWORD = $row['password'];

    $mysqli = new mysqli($SERVER, $USER, $PASSWORD);
    $sql = "CREATE DATABASE $DB";
    $qr = $mysqli->query($sql);

    $mysqli = new mysqli($SERVER, $USER, $PASSWORD, $DB);
    $handle = @fopen("database.sql", "r");
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
            $buffer = str_replace(array("\r", "\n"), "", $buffer);
            $qr = $mysqli->query($buffer);
        }
        if (!feof($handle)) {
            echo "Error: unexpected fail\n";
        }
        fclose($handle);
    }