<?php include'includes/header.php'; ?>
<?php

$id = $_GET['id'];

  // Create DB Object
    $db = new Database();

    // Create Query posts
    $query = "SELECT * FROM categories WHERE id =".$id;

    // Run Query
    $category = $db->select($query)->fetch_assoc();

    // UPDATE
    if(isset($_POST['submit'])){
        // Assig Vars
      
        $name = mysqli_real_escape_string($db->link, $_POST['name']);
     
      
        // Simple Validation
        if($name == ''){
            // Set eror
            echo $error = 'Please fill out all required fields';
        }else{
            
            $query = "UPDATE categories SET name='$name' WHERE id =".$id;
            $update_row = $db->update($query);
        }
      
      }
      
    // DELETE
 if(isset($_POST['delete'])){
    $query = "DELETE FROM categories WHERE id=".$id;
    $delete_row = $db->delete($query);
  
} 
?>

<form action="edit_category.php?id=<?php echo $id; ?>" method="POST" role="form">
    <div class="form-group">
        <label for="">Category Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo $category['name'];?>">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
    <input type="submit" value="delete" class="btn btn-danger pull-middle" name="delete">
    <a href="index.php" class="btn btn-primary pull-right">Cancel</a>
</form>
<?php include'includes/footer.php'; ?>