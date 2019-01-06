<?php include'includes/header.php'; ?>
<?php 
  // Create DB Object
  $db = new Database();

if(isset($_POST['submit'])){
    // Assig Vars
 
    $name = mysqli_real_escape_string($db->link, $_POST['name']);
    // Simple Validation
    if($name == '' ){
        // Set eror
        echo $error = 'Please fill out all required fields';
    }else{
        
        $query = "INSERT INTO categories (name) 
                    VALUES('$name')";
        $update_row = $db->insert($query);
    }

}
?>
<form action="add_category.php" method="POST" role="form">
    <div class="form-group">
        <label for="">Category Name</label>
        <input type="text" class="form-control" name="name" placeholder="Category Name">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <a href="index.php" class="btn btn-primary pull-right">Cancel</a>
</form>
<?php include'includes/footer.php'; ?>