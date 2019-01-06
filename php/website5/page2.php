<?php 
//Change cooki
// setcookie('username', 'Andrei', time()+ (86400*30));
// Delete cooki
// setcookie('username', 'Andrei', time() - 3600);
if(isset($_COOKIE['username'])){
    echo 'User'. $_COOKIE['username'].' is set<br>';
}else {
    echo 'User is not set';
}