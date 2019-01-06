<?php include'includes/header.php'; ?>
<?php
 // Create DB Object
 $db = new Database();
  // Check url for categories
  if (isset($_GET['categories'])){
    $categories = $_GET['categories'];
     // Create Query posts
     $query = "SELECT * FROM posts WHERE categories =".$categories." ORDER BY id DESC";

     // Run Query
     $posts = $db->select($query);

  }else{
     // Create Query posts
     $query = "SELECT * FROM posts ORDER BY id DESC";

     // Run Query
     $posts = $db->select($query);
  }
    // Create Query Categories
    $query = "SELECT * FROM categories";

    // Run Query
    $categories = $db->select($query);
    
?>
<?php if($posts): ?>
  <?php while($row = $posts->fetch_assoc()): ?>
          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $row['title']; ?></h2>
            <p class="blog-post-meta"><?php echo formatDate($row['data']); ?> by <a href="#"><?php echo $row['author']; ?></a></p>
            <p><?php echo shortenText($row['body']); ?></p>  
            <a class="readmore" href="post.php?id=<?php echo urlencode($row['id']); ?>">Read More..</a>
          </div><!-- /.blog-post -->
<?php endwhile; ?>
         
<?php else: ?> 
  <p>There are no post yet</p>
<?php endif; ?>      
<?php include'includes/footer.php'; ?>
        