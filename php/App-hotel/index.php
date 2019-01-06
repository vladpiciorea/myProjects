<?php
    require_once './core/init.php';
    include_once './helpers/helpers.php';   
    include './includes/head.php';
    include './includes/navigation.php';
// Sanitizare date intrare
    $email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
    $email = trim($email);

    $password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');

    $password = trim($password);
    $errors = array();

    if($_POST) {
    // Verificare email 
        if(empty($_POST['email']) || empty($_POST['password'])) {
            $errors[] = ' Trebuie sa introduci emailul si parola. ';
        }
    
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $errors[] = ' Trebuie sa introduci o adresa de email corecta. ';
        }

    // Verificare lungime password
        if(strlen($password) < 4) {
            $errors[] = " Parola trebuie sa aiba minim 4 carcatere. ";
        }
    // Verificare daca email exista in db
        $query = $db->query("SELECT * FROM users WHERE email = '$email'");
        $user = mysqli_fetch_assoc($query);
        $userCount = mysqli_num_rows($query);

        if($userCount < 1) {
            $errors[] = 'Adresa de email nu exista.';
        }

    // Verificare parola
        if(!password_verify($password,$user['password'])) {
            $errors[] = ' Parola nu este corecta';
        }

    // Afisare errori
        if(!empty($errors)) {
            echo dysplay_errors($errors);
        }else {
            
        // log user
            $user_id = $user['id'];
            login($user_id);
        }
    } 
?>
<?php if(!is_logged_in()):?>
                   
    <div class="container">
        <h2 class="text-center">Login</h2>
        <form action="index.php" method="POST">
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
        <p class="text-right">
            <a href="/ecomerce/index.php" alt="home">Home page</a>
        </p>
    <div>
<?php else: ?> 

    <h1>Hompage</h1>

<?php endif; ?>

<?php include 'includes/footer.php';?>