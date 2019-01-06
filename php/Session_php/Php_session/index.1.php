<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    // **** $_SESSION si setcookie *****
    // $_SESSION pt inf imprtante Ex: parole
    // setcookie pt informati non imoportante 
        setcookie("name","Daniel",time() + 86400);
        $_SESSION['name'] = "12";
    ?>
</body>
</html>