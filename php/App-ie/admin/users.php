<?php
   require_once $_SERVER['DOCUMENT_ROOT'] . '/ie/core/init.php';
   include_once $_SERVER['DOCUMENT_ROOT'] . '/ie/helpers/helpers.php';
    if(!is_logged_in()) {
        login_error_redirect();
    }
    if(!has_permission('admin')) {
        permission_error_redirect('index.php');
    }
    include 'includes/head.php';
    include 'includes/navigation.php';
    if(isset($_GET['delete'])) {
        $delete_id = sanitize($_GET['delete']);
        $db->query("DELETE FROM users WHERE id = '$delete_id'");
        $_SESSION['success_flash'] = 'Utilizatorul a fost sters';
        header('Location: users.php');
    }
    if(isset($_GET['add'])) {
        $name = ((isset($_POST['name']))? sanitize($_POST['name']) : '');
        $email = ((isset($_POST['email']))? sanitize($_POST['email']) : '');
        $password = ((isset($_POST['password']))? sanitize($_POST['password']) : '');
        $confirm = ((isset($_POST['confirm']))? sanitize($_POST['confirm']) : '');
        $permissions = ((isset($_POST['permissions']))? sanitize($_POST['permissions']) : '');
        $errors = array();
        if($_POST) {
            $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
            $emailCount = mysqli_num_rows($emailQuery);
            if($emailCount != 0) {
                $errors[] = 'Adresa de email exista ';
            }
            $required = array('name', 'email', 'password', 'confirm', 'permissions');
            foreach($required as $f) {
                if(empty($_POST[$f])) {
                    $errors[] = 'Trebuie sa completezi toate casutele';
                    break;
                }
            }

            if(strlen($password) < 5 ) {
                $errors[] = 'Parola trebuie sa aiba minim 5 caractere';
            }

            if($password != $confirm) {
                $errors[] = 'Parolele nu se potrivesc';
            }

            if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Trebuie sa introduci o adresa de email valida';
            }

            if(!empty($errors)) {
                echo dysplay_errors($errors);
            } else {
                // adauga utilizator
                $hashed = password_hash($password,PASSWORD_DEFAULT);
                $db->query("INSERT INTO users (full_name, email, password, permissions) 
                            VALUES('$name','$email','$hashed', '$permissions')");
                $_SESSION['success_flash'] = 'Utilizatorul a fost adaugat';
                header("Location: users.php");
            }
        }

        ?>
        <h2 class="text-center">Adauga un utilizator nou</h2>
        <hr>
        <form action="users.php?add=1" method="post">
            <div class="form-group col-md-6">
                <label for="name">Nume:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Emial:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="password">Parola:</label>
                <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="confirm">Confirmare parola:</label>
                <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="permissons">Permisiuni:</label>
                <select class="form-control" name="permissions">
                    <option value="" <?= (($permissions == '') ? 'selected': '') ?>></option>
                    <option value="edit" <?= (($permissions == 'edit') ? 'selected': '') ?>>Editor</option>
                    <option value="admin,edit" <?= (($permissions == 'admin,edit') ? 'selected': '') ?>>Admin</option>
                </select>
            </div>
            <div class="form-group col-md-6 text-right" style="margin-top:25px">
                <a href="usrs.php" class="btn btn-default">Cancel</a>
                <input type="submit" value="Adauga utilizator" class="btn btn-primary">
            </div>
        </form>
        <?php
    }else{
    $userQuery = $db->query("SELECT * FROM users ORDER BY full_name");
?>

<h2 class="text-center">Users</h2>
<a href="users.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Adauga utilizator nou</a>
<div class="clearfix"></div>
<hr>
<table class="table table-bordered tabble-striped table-condensed">
    <thead>
        <th></th>
        <th>Name</th>
        <th>Email</th>
        <th>Data cand a  fost creat</th>
        <th>Ultima logare</th>
        <th>Permisiuni</th>
    </thead>
    <?php while($user = mysqli_fetch_assoc($userQuery)): ?>
        <tr>
            <td>
                <?php if($user['id'] != $user_data['id']): ?>
                    <a href="users.php?delete=<?= $user['id'];?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
                <?php endif;?>
            </td>
            <td><?=$user['full_name'];?></td>
            <td><?=$user['email'];?></td>
            <td><?=pretty_date($user['join_date']);?></td>
            <td><?=(($user['last_login'] == '0000-00-00 00:00:00')? 'Niciodata': pretty_date($user['last_login']));?></td>
            <td><?=$user['permissions'];?></td>
        </tr>
    <?php endwhile;?>
</table>
    <?php } include 'includes/footer.php'; ?>