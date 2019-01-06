<?php include'includes/header.php'; ?>
<?php
$id = $_GET['id'];
  // Create DB Object
    $db = new Database();

    // Create Query posts
    $query = "SELECT * FROM posts WHERE id= ".$id;

    // Run Query
    $post = $db->select($query)->fetch_assoc();

    // Create Query Categories
    $query = "SELECT * FROM categories";

    // Run Query
    $categories = $db->select($query);
    
// Update 
if(isset($_POST['submit'])){
  // Assig Vars

  $title = mysqli_real_escape_string($db->link, $_POST['title']);
  $body = mysqli_real_escape_string($db->link, $_POST['body']);
  $category= (isset($_POST['category']))? mysqli_real_escape_string($db->link, $_POST['category']) : ''; 
  $author = mysqli_real_escape_string($db->link, $_POST['author']);
  $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

  // Simple Validation
  if($title == '' || $body= '' || $category == ''  || $author == ''){
      // Set eror
      echo $error = 'Please fill out all required fields';
  }else{
      
      $query = "UPDATE posts 
                SET title='$title',
                    body = '$body',
                    categories = '$category',
                    author = '$author',
                    tags = '$tags'
                    WHERE id =".$id;
      $update_row = $db->update($query);
  }

}

// DELETE
 if(isset($_POST['delete'])){
    $query = "DELETE FROM posts WHERE id=".$id;
    $delete_row = $db->delete($query);
  
}  
?>
<form method="post" action="edit_post.php?id=<?php echo $id; ?>" >
  <div class="form-group">
    <label>Post title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $post['title'];?>">  
  </div>
  <div class="form-group">
    <label>Post Body</label>
    <textarea name="body" class="form-control"><?php echo $post['body'];?></textarea>  
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
    <input type="text" class="form-control" name="author" value="<?php echo $post['author'];?>" >  
  </div>
  <div class="form-group">
    <label>Tags</label>
    <input type="text" class="form-control" name="tags" value="<?php echo $post['tags'];?>">  
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <input type="submit" value="delete" class="btn btn-danger pull-middle" name="delete">
  <a href="index.php" class="btn btn-primary pull-right">Cancel</a>
</form>
<?php include'includes/footer.php'; ?>