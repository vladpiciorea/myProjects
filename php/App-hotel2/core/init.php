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
if(isset($_SESSION['User'])) {
    $user_id = $_SESSION['User'];
    $query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
    $user_data = mysqli_fetch_assoc($query);
}

if(isset($_SESSION['success'])) {
    echo '<div class="bg-success"><p class="text-success text-center">' .$_SESSION['success'] . '</p></div>';
    unset($_SESSION['success']);
}
if(isset($_SESSION['error'])) {
    echo '<div class="bg-danger"><p class="text-danger text-center">' .$_SESSION['error'] . '</p></div>';
    unset($_SESSION['error']);
}
// Login cu inserare ultimei logari
function login($user_id) {
    $_SESSION['User'] = $user_id;
    $_SESSION['success'] = 'Esti logat';
    header('Location: index.php');

}
// Verificare daca este logat
function logged_in () {


    if(isset($_SESSION['User']) && $_SESSION['User'] > 0) {
        return true;
    }else {
        return false;
    }
}

//Mesaj redirectionare
function login_error($url = 'index.php') {

    $_SESSION['error'] = 'Pagina nu este disponibila';
    header('Location: '.$url);
}