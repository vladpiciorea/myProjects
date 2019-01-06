<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Quizzer</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>PHP Quizzer</h1>
        </div>
    </header>
    <main>
        <div class="container">
           <h2>You're Done!</h2>
           <p>Congrats! You heve completed the test</p>
           <p>Final score: <?php  echo (isset($_SESSION['score'])) ? $_SESSION['score']: '' ; ?></p>
           <a href="question.php?n=1" class="start">Take Again</a>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2014,
        </div>
    </footer>
</body>
</html>
<?php session_unset(); ?>