<?php
// Initializare baza de date
    $db = mysqli_connect('127.0.0.1', 'root', '', 'hotel');
    if(mysqli_connect_errno()) {
        echo 'Database connection failed with errors:'. mysqli_connect_errno();
        die();
    }
// Pornire sesine
session_start();

// 
if(isset($_SESSION['SBUser'])) {
    $user_id = $_SESSION['SBUser'];
    $query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($query);
}

if(isset($_SESSION['success_flash'])) {
    echo '<div class="bg-success"><p class="text-success text-center">' .$_SESSION['success_flash'] . '</p></div>';
    unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])) {
    echo '<div class="bg-danger"><p class="text-danger text-center">' .$_SESSION['error_flash'] . '</p></div>';
    unset($_SESSION['error_flash']);
}