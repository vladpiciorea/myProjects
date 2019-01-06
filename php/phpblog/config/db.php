<?php
//  create connection
$conn = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_Name);

// Check connection
if(mysqli_connect_errno()){
    // Connection Failed
    echo 'Faild to connect to MySqul'.mysqli_connect_errno();
}