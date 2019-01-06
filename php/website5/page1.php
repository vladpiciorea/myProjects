<?php
    if(isset($_POST['submit'])){
        $username = htmlentities($_POST['username']);
        setcookie('username', $username, time()+3600);
        //param 1 numele cookiului param2 valoare si 3 timpul de expirare
        header('Location: page2.php');

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Cookies</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cyborg/bootstrap.min.css">
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
        <legend>PHP Cookies</legend>
    <div class="container">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Name">
        </div>
    
        <button type="submit" class="btn btn-primary" name = 'submit'>Submit</button>
        </div>
    </form>
    
</body>
</html>