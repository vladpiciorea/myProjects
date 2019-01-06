<?php

$user = 'root';
$password = 'root';
$db = 'loginsystem';
$host = 'localhost';
$port = 3307;

$link = mysqli_connect(
   "$host:$port", 
   $user, 
   $password
);
$db_selected = mysql_select_db(
   $db, 
   $link
);

?>