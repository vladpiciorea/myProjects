<?php include'includes/header.php'; ?>
<?php 
  // Create DB Object
  $db = new Database();

if(isset($_POST['submit'])){
    // Assig Vars
      $title = mysqli_real_escape_string($db->link, $_POST['title']);
      $category= (isset($_POST['category']))? mysqli_real_escape_string($db->link, $_POST['category']) : '';    
      $body = mysqli_real_escape_string($db->link, $_POST['body']);
      $author = mysqli_real_escape_string($db->link, $_POST['author']);
      $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

      // Simple Validation
      if($title == '' || $body= '' || $category == ''  || $author == ''){
          // Set eror
          echo $error = 'Please fill out all required fields';
      }else{
          $query = "INSERT INTO posts (title,  categories, author, tags, body) 
                      VALUES('$title', $category, '$author', '$tags', '$body')";
          $insert_row = $db->insert($query);
      }
   
}
?>
<?php

    // Create Query Categories
    $query = "SELECT * FROM categories";

    // Run Query
    $categories = $db->select($query);
    
?>
<form method="POST" action="add_post.php">
  <div class="form-group">
    <label>Post title</label>
    <input type="text" class="form-control" name="title" placeholder="Enter Title">  
  </div>
  <div class="form-group">
    <label>Post Body</label>
    <textarea  class="form-control" name="body"></textarea>  
  </div>
  <div class="form-group">
    <label>Category</label>
    <select multiple class="form-control" name="category">
    <?php while ($row = $categories->fetch_assoc()):?>
    <?php if($row['id'] == $post['categories']){
         $selected= 'selected';
         }else{
             $selected = '';
         }
    ?>
      <option <?php echo $selected ; ?> value="<?php echo $row['id']; ?>"> <?php echo $row['name'];?> </option>
    <?php endwhile; ?>
    </select> 
  </div>
  <div class="form-group">
    <label>Author</label>
    <input type="text" class="form-control" name="author" placeholder="Enter Author Name">  
  </div>
  <div class="form-group">
    <label>Tags</label>
    <input type="text" class="form-control" name="tags" placeholder="Enter Tags">  
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <a href="index.php" class="btn btn-primary pull-right">Cancel</a>
</form>
<?php include'includes/footer.php'; ?>