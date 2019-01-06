<?php
require ('config/config.php');
require ('config/db.php');
// Check For Submit
if(isset($_POST['delete'])){
    // Get form data
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    
$query = "DELETE FROM posts WHERE id = {$delete_id}";

    if(mysqli_query($conn, $query)){
        header('Location: '.ROOT_URL.'');
    } else {
        echo 'ERROR: '. mysqli_error($conn);
    }
}

// get id
$id = mysqli_real_escape_string($conn, $_GET['id']);

// Create Query
$query = 'SELECT * FROM posts WHERE id='.$id;

// Get Result
$result = mysqli_query($conn, $query);

// Fetch Data

$post = mysqli_fetch_assoc($result);
// var_dump($posts);
// Free result
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>
<?php include ('inc/header.php') ?>

<div class="container">
    <a class = "btn btn-default" href="<?php echo ROOT_URL; ?>">Back</a>
    <h1><?php echo $post['title'];?></h1>
        <small>
            Create on <?php echo $post['creatted_at']; ?>
            by <?php echo $post['author']; ?>
            <p><?php echo $post['body']; ?></p>
            <hr>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class = "pull-right" method="post">
            
                <input type="hidden" name = "delete_id" value="<?php echo $post['id']; ?>">
                <input type="submit" value="delete" name ="delete" class = "btn btn-danger">
            </form>

            <a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>"
            class = "btn btn-default">Edit</a>
        </small>
    </div>
<?php include ('inc/footer.php') ?>