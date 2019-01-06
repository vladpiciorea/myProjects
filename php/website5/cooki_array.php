<?php
$user = ['name' => 'Vlad', 'email'=> 'vald@yahoo.com','age' => 35];

$user = serialize($user);

setcookie('user', $user, time()+ (8640*30));

$user = unserialize($_COOKIE['user']);
echo $user['name'];
echo '<pre>';
print_r ($user);
?>