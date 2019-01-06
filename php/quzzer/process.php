<?php include'database.php'; ?>
<?php session_start(); ?>
<?php 
// Check to see if score is set
if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}
if(isset($_POST['submit'])){
    // numarul intrebarii
    $number = $_POST['number'];
    // varianta aleasa
    $selected_choice= $_POST['choice'];
    $next = $number+1;

    // Get total

    $query = "SELECT * FROM questions";
    
    //Get result 
    $result= $mysqli->query($query) or die($mysqli->error.__LINE__);
    $total = $result->num_rows;

    // Get correct choice

    $query = "SELECT * FROM choices WHERE question_number= $number And is_correct=1";

    // Get result
    $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

    // Get row
    $row= $result->fetch_assoc();

    // set correct choice
    $correct_choice = $row['id'];
    // echo $correct_choice; die();
    // Compare
    if($correct_choice == $selected_choice){
        // Answer correct
        $_SESSION['score']++;
        // echo $_SESSION['score']; die();
    }

    // Check if is last
    if($number == $total){
        header("Location: final.php");
        exit();
    }else{
        header("Location: question.php?n=$next");
    }
}