<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>
    <ul>
        <li><a href="index.php">Home</a></li>   
        <li><a href="contact.php">Contact</a></li>
    </ul>
<?php
    $_SESSION['username'] = 'Vlad';
    echo $_SESSION['username'];
?>
</h3>
</body>
</html>