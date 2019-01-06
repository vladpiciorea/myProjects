<?php
    if(isset($_POST['submit'])){
        session_start();//Start sesion
        $_SESSION['name'] = htmlentities($_POST['name']);
        $_SESSION['email'] = htmlentities($_POST['email']);
        header('Location: page2.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/united/bootstrap.min.css">
</head>
<body>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
    <div class="container">
        <legend>Form title</legend>
    
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" placeholder="Enter email">
        </div>
       
        <button type="submit" class="btn btn-primary" name = "submit">Submit</button>
    </div>
    </form>
    
</body>
</html>