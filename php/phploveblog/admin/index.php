<?php include'includes/header.php'; ?>
<?php
// create Database
$db = new Database;

// Create Query Posts
$query= "SELECT posts.*, categories.name  FROM posts INNER JOIN categories on posts.categories =  categories.id
        ORDER BY posts.id DESC";

// Run Query
$posts = $db->select($query);

 // Create Query Categories
 $query = "SELECT * FROM categories ORDER BY categories.id DESC";

 // Run Query
 $categories = $db->select($query);

?>
     <table class="table teble-striped">
        <tr>
            <th>Post Id#</th>
            <th>Post Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Date</th>
        </tr>
        <?php while($row= $posts->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><a href="edit_post.php?id=<?php echo $row['id'];?>"> <?php echo $row['title'];?> </a></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['author'];?></td>
                <td><?php echo formatDate($row['data']);?></td>
            </tr>
        <?php endwhile; ?>
        
     </table>
     <table class="table teble-striped">
        <tr>
            <th>Category Id#</th>
            <th>Category Name</th>
            
        </tr>
        <?php while($row= $categories->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><a href="edit_category.php?id=<?php echo $row['id'];?>"> <?php echo $row['name'];?> </a></td>
            </tr>
        <?php endwhile; ?>
     </table>
<?php include'includes/footer.php'; ?>