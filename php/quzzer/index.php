<?php include'database.php'; ?>
<?php 
// Get total number of Questions
$query = "SELECT * FROM questions";
// Get result
$results = $mysqli->query($query) or die($mysqli->error.__LINE__);
$total = $results->num_rows;
?>
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
            <h2>Test Your Php Knowledge</h2>
            <p>This is a multiple choise quzi to test your Knowledge of PHP</p>
            <ul>
                <li><strong>Number of Questions:</strong> <?php echo $total; ?></li>
                <li><strong>Type:</strong>Multiple choise</li>
                <li><strong>Estimated Time:</strong><?php echo $total*.5; ?> minutes</li>
            </ul>
            <a href="question.php?n=1" class="start">Start Quiz</a>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2014,
        </div>
    </footer>
</body>
</html>