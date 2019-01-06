<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ie/core/init.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ie/helpers/helpers.php';
    include 'includes/head.php';

    $email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
    $email = trim($email);

    $password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');

    $password = trim($password);
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
                if(empty($_POST['email']) || empty($_POST['password'])) {
                    $errors[] = 'Trebuie sa introduci emailul si parola. ';
                }
                // valdate email
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    $errors[] = ' Trebuie sa introduci o adresa de mail corecta. ';
                }

                // Password is more thet 6 caracthers
                if(strlen($password) < 2) {
                    $errors[] = " Parola trebuie sa aiba minim 6 carcatere. ";
                }
                // check if email exist in the db
                $query = $db->query("SELECT * FROM users WHERE email = '$email'");
                $user = mysqli_fetch_assoc($query);
                $userCount = mysqli_num_rows($query);
                if($userCount < 1) {
                    $errors[] = 'Adresa de mail nu exista.';
                }

                if(!password_verify($password,$user['password'])) {
                    $errors[] = 'Parola nu este corecta';
                }


                if(!empty($errors)) {
                    echo dysplay_errors($errors);
                }else {
                    // log user
                    $user_id = $user['id'];
                    login($user_id);
                }
            }
        ?>
    </div>
        <h2 class="text-center">Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
            </div>
            <div class="form-group">
                <label for="password">Parola: </label>
                <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-primary">
            </div>
        </form>
        <p class="text-right"><a href="/ecomerce/index.php" alt="home">Home page</a></p>
</div>

<?php include 'includes/footer.php'; ?>