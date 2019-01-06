<?php include'database.php'; ?>
<?php
    if(isset($_POST['submit'])){
        // Get post variable
        $question_number = $_POST['question_number'];
        $question_text = $_POST['question_text'];
        // Choices array
        $choices = array();
        $choices[1] = $_POST['choice1'];
        $choices[2] = $_POST['choice2'];
        $choices[3] = $_POST['choice3'];
        $choices[4] = $_POST['choice4'];
        $choices[5] = $_POST['choice5'];
        $corectr_choice = $_POST['corectr_choice'];
        // question query

        $query = "INSERT INTO questions (question_number, text)
                    VALUES ('$question_number', '$question_text')";
        // Run query
        $inser_row = $mysqli->query($query) or die($mysqli->error.__LINE__);

    // Valditre insert
    if($inser_row){
        foreach($choices as $choice=> $value){
            if ($value !== ''){
                if($corectr_choice == $choice){
                    $is_correct = 1;
                }else{
                    $is_correct = 0;
                }
                // Choice query
                $query = "INSERT INTO choices (question_number, is_correct,text)
                            VALUES ('$question_number', '$is_correct','$value')";
                // Run query
                $inser_row = $mysqli->query($query) or die($mysqli->error.__LINE__);
                
                 // Valditre insert
                 if($inser_row){
                     continue;
                 }else{
                     die('Error: ('.$mysqli->errno.') '.$mysqli->error);
                 }
            }
        }

        $msg = 'Question has been aded';
    }
    }
     // Get total

     $query = "SELECT * FROM questions";
    
     //Get result 
     $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
     $total = $result->num_rows;
     $next = $total +1;
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
            <h2>Add A Question</h2>
            <?php if(isset($msg)){
                echo $msg;
            }        
            ?>
            <form action="add.php" method="post">
                <p>
                    <label>Question Number:</label>
                    <input type="number" name="question_number" value="<?php echo $next; ?>">    
                </p>
                <p>
                    <label>Question Text:</label>
                    <input type="Text" name="question_text">    
                </p>
                <p>
                    <label>Chice #1:</label>
                    <input type="Text" name="choice1">    
                </p>
                <p>
                    <label>Chice #2:</label>
                    <input type="Text" name="choice2">    
                </p>
                <p>
                    <label>Chice #3:</label>
                    <input type="Text" name="choice3">    
                </p>
                <p>
                    <label>Chice #4:</label>
                    <input type="Text" name="choice4">    
                </p>
                <p>
                    <label>Chice #5:</label>
                    <input type="Text" name="choice5">    
                </p>
                <p>
                    <label>Corect Choice Number</label>
                    <input type="number" name="corectr_choice">    
                </p>
                <input type="submit" value="submit" name="submit">
            </form>
        </div>
    </main>
    <footer>
        <div class="container">
            Copyright &copy; 2014,
        </div>
    </footer>
</body>
</html>