<?php
require ('config/config.php');
require ('config/db.php');

// Create Query
$query = 'SELECT * FROM posts ORDER BY creatted_at DESC';

// Get Result
$result = mysqli_query($conn, $query);

// Fetch Data

$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
// var_dump($posts);
// Free result
mysqli_free_result($result);

// Close connection
mysqli_close($conn);
?>
<?php include ('inc/header.php') ?>
<div class="container">
    <h1>Post</h1>
    <?php foreach($posts as $post): ?>
    <div class="jumbotron">
    <h3><?php echo $post['title'];?></h3>
        <small>
            Create on <?php echo $post['creatted_at']; ?>
            by <?php echo $post['author']; ?>
            <p><?php echo $post['body']; ?></p>
            <a calss = "btn btn-default" href= "<?php echo ROOT_URL; ?>post.php?id=<?php  echo $post['id']; ?>">Reed more</a>
        </small>
    </div>
    <?php endforeach;?>
</div>
<?php include ('inc/footer.php') ?>