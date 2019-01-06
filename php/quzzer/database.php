<?php

    // Create connection credentials
    $db_host = 'localhost';
    $db_users = 'root';
    $db_pass = '';
    $db_name = 'quzzer';

    // Create myqli object
    $mysqli = new mysqli($db_host, $db_users, $db_pass, $db_name);

    // error handler
    if($mysqli->connect_error){
        printf("Connect failed: %s\n",$mysqli->connect_error);
        exit();
    }