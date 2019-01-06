<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'pdotest';

// Set DSN
$dsn = 'mysql:host='.$host.';dbname='. $dbname;

// Create PDO instance
$pdo = new PDO($dsn, $user, $password);
// Pentru a primi datele sub forma de obict
// fara a mai scrie in paranteza $stmt->fetchAll(PDO::FETCH_OBJ);
// se setaza un atribut
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

// Nu este sigura
// $status = admin;
// $sql = "SELECT * FROM users WHERE status = $status";

// Varianta sigura cu name param
$status = 'admin';
$sql = 'SELECT * FROM users WHERE status = :status';
$stmt = $pdo->prepare($sql);
// Pune in loc de status ce e in variabila $status
$stmt->execute(['status' => $status]);
// // Returneaza un array
// $usesrs = $stmt->fetchAll();

// foreach($usesrs as $user) {
//     echo $user['name']. '<br>';
// }

// // Pt un obiect
// // Fara a seta atributul 
// // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
// $usesrs = $stmt->fetchAll(PDO::FETCH_OBJ);

// Cu atributul setat
$usesrs = $stmt->fetchAll();
foreach($usesrs as $user) {
    echo $user->name . '<br>';
}

// Insert

$name = 'Picioare';
$email = 'asas@gmail';
$status = 'guest';

$sql = 'INSERT INTO users(name, email, status) 
        VALUES(:name, :email, :status)';
$stmt = $pdo->prepare($sql);
$stmt->execute(['name' => $name, 'email' => $email, 'status' => $status]);
echo 'User adaugat';


