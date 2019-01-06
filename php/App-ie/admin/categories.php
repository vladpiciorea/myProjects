<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ie/core/init.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ie/helpers/helpers.php';
    if(!is_logged_in()) {
        login_error_redirect();
    }
    include 'includes/head.php';
    include 'includes/navigation.php';

    $sql = "SELECT * FROM categories WHERE parent = 0";
    $result = $db->query($sql);

    $errors = array();

    // Edit category

    if(isset($_GET['edit']) && !empty($_GET['edit'])) {
        $edit_id = (int)$_GET['edit'];
        $edit_id = sanitize($edit_id);
        $edit_sql = "SELECT * FROM categories WHERE id = '$edit_id'";
        $edit_result = $db->query($edit_sql);
        $edit_category = mysqli_fetch_assoc($edit_result);
        $parent_val = $edit_category['parent'];
    }

    // Delete Category
    if(isset($_GET['delete']) && !empty($_GET['delete'])) {
        $delete_id = (int)$_GET['delete'];
        $delete_id = sanitize($delete_id);
        $sql = "SELECT * FROM categories WHERE id =  '$delete_id'";
        $db->query($sql);
        $category = mysqli_fetch_assoc($result);
        if($category['parent'] == 0) {
            $dsql = "DELETE FROM categories WHERE parent = '$delete_id'";
            $db->query($sql);
        }
        $dsql = "DELETE FROM categories WHERE id = '$delete_id'";
        $db->query($dsql);
        header('Location: categories.php');
    }

    // Precess Form
    if(isset($_POST) && !empty($_POST)) {
        $parent = sanitize($_POST['parent']);
        $category = sanitize($_POST['category']);
        $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$parent'";
        $fresults = $db->query($sqlform);
        $count = mysqli_num_rows($fresults);

    // Daca nu s-a introdus categorie
        if($category == '') {
            $errors[] .='Trebuie sa introduci o categorie';
        }

    // Verifica daca exista categoria in DB
        if($count > 0) {
            $errors[] .= 'Categoria ' . $category. ' exista';
        }

    // Dysplay Errors or update db
        if(!empty($errors)) {
            $display = dysplay_errors($errors);
        }else {
            if(isset($_GET['edit'])) {
                $updatesql = "UPDATE categories SET category ='$category', parent ='$parent' WHERE id ='$edit_id'";
            }else {
            $updatesql = "INSERT INTO categories(category, parent) VALUES ('$category','$parent')";
            }
            $db->query($updatesql);
            header('Location: categories.php');
        }
    }
?>
<h2 class="text-center">Categorii</h2>
<hr>
<div class="row">
    <div class="col-md-6">

    <!-- Form -->
    <form action="categories.php<?=((isset($_GET['edit']))? '?edit='.$edit_id : '') ?>" method="post" class="form">
        <legend><?= ((isset($_GET['edit']))? 'Editeaza' : 'Adauga') ;?> o categorie</legend>
        <div class="errors"><?=((isset($display))? $display : '') ?></div>
        <div class="form-group">
            <label for="parent">Parinte</label>
            <select name="parent" id="parent" class="form-control">
                <option value="0" > Parintele</option>
                    <?php while($parent = mysqli_fetch_assoc($result)): ?>
                        <option value="<?= $parent['id']; ?>" 
                        <?php if(isset($parent_val) && $parent_val == $parent['id'] ) {
                                    echo 'selected = "selected" ';
                                } ?> >
                        <?= $parent['category'];  ?> 
                        </option>
                    <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Categorii</label>
            <input type="text" name="category" id="category" class="form-control" value="<?=((isset($edit_category['category'])) ? $edit_category['category'] : '') ?>">
        </div>
        <div class="form-group">
            <input type="submit" value= "<?= ((isset($_GET['edit']))? 'Editeaza Categoria' : 'Adauga Categoria') ;?>" class="btn btn-success">
        </div>

    </form>
    <!-- Category tabele -->
    </div>
    <div class="col-md-6">
        <table class="table table-bordered">
                <thead>
                    
                    <th>Categorii</th>
                    <th>Parinte</th>
                    <th></th>
                </thead>
                <tbody>
                
                    <?php
                    $sql = "SELECT * FROM categories WHERE parent = 0";
                    $result = $db->query($sql);
                    while($parent = mysqli_fetch_assoc($result)): 
                        $parent_id = (int)$parent['id'];
                        $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
                        $cresult = $db->query($sql2);    
                    ?>
                        <tr class="bg-primary">
                            <td><?=$parent['category']; ?></td>
                            <td>Parinte</td>
                            <td>
                                <a href="categories.php?edit=<?=$parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="categories.php?delete=<?=$parent['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                            </td>
                        </tr>
                    <?php while($child = mysqli_fetch_assoc($cresult)): ?>
                    <tr class="bg-info">
                            <td><?=$child['category']; ?></td>
                            <td><?=$parent['category']; ?></td>
                            <td>
                                <a href="categories.php?edit=<?=$child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                                <a href="categories.php?delete=<?=$child['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php endwhile; ?>
                </tbody>
        </table>
    </div>
</div>
<?php include 'includes/footer.php'; ?>