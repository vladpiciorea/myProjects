<?php
    require_once '../core/init.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ie/helpers/helpers.php';

    if(!is_logged_in()) {
        login_error_redirect();

    }
    include 'includes/head.php';
    $hashed = $user_data['password'];
    $user_id = $user_data['id'];
    $old= ((isset($_POST['old'])) ? sanitize($_POST['old']) : '');
    $old = trim($old);
    $password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
    $password = trim($password);
    $confirm = ((isset($_POST['confirm'])) ? sanitize($_POST['confirm']) : '');
    $confirm = trim($confirm);
    $new_hashed = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();
    ?>
<style>
    body{
        background-image: url(images/login_bg.jpg);
        background-size: 100vw 100vh;
        background-attachment: fixed;
    }
</style>
<div id="login-form">
    <div>
        <?php
            if($_POST) {
                // form validation
                if(empty($_POST['old']) || empty($_POST['old']) || empty($_POST['confirm']) ) {
                    $errors[] = 'Completeaza toate domenile';
                }

                // Password is more thet 6 caracthers
                if(strlen($password) < 5) {
                    $errors[] = "Parola trebuie sa aiba minim 6 carcatere";
                }
                
                // if new pass mach confirm
                if($password != $confirm) {
                    $errors[] = 'Parolele nu se potrivesc';
                }

                if(!password_verify($old,$hashed)) {
                    $errors[] = 'Parola veche nu este corecta';
                }


                if(!empty($errors)) {
                    echo dysplay_errors($errors);
                }else {
                    // change password
                    $db->query("UPDATE users SET password = '$new_hashed' WHERE id = '$user_id'");
                    $_SESSION['success_flash'] = 'Parola a fost schimbata';
                    header('Location: index.php');
                }
            }
        ?>
    </div>
        <h2 class="text-center">Schimba parola</h2>
        <form action="change_password.php" method="post">
            <div class="form-group">
                <label for="old">Parola veche: </label>
                <input type="password" name="old" id="old" class="form-control" value="<?=$old;?>">
            </div>
            <div class="form-group">
                <label for="password">Parola: </label>
                <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
            </div>
            <div class="form-group">
                <label for="confirmare">Confirmare parola: </label>
                <input type="password" name="confirm" id="confirmare" class="form-control" value="<?=$confirm;?>">
            </div>
            <div class="form-group">
                <a href="index.php" class="btn btn-default">Cancel</a>
                <input type="submit" value="Schimba" class="btn btn-primary">
            </div>
        </form>
        <p class="text-right"><a href="/ecomerce/index.php" alt="home">Home page</a></p>
</div>

<?php include 'includes/footer.php'; ?>