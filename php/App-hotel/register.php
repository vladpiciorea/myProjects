<?php
    require_once './core/init.php';
    include_once './helpers/helpers.php';   
    include './includes/head.php';
    include './includes/navigation.php';
// Verificare daca userul este logat
    if(is_logged_in()) {
        login_error_redirect();
    } 

// Sanitizare date intrare
    $name = ((isset($_POST['name']))? sanitize($_POST['name']) : '');
    $username = ((isset($_POST['username']))? sanitize($_POST['username']) : '');
    $email = ((isset($_POST['email']))? sanitize($_POST['email']) : '');
    $password = ((isset($_POST['password']))? sanitize($_POST['password']) : '');
    $confirm = ((isset($_POST['confirm']))? sanitize($_POST['confirm']) : '');

    $errors = array();

        if($_POST) {

        // Verificare completare input
            $required = array('name', 'email', 'password', 'confirm');
            foreach($required as $f) {
                if(empty($_POST[$f])) {
                    $errors[] = ' Trebuie sa completezi toate casutele';
                    break;
                }
            }

        // Verificare duplicat email
            $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
            $emailCount = mysqli_num_rows($emailQuery);
            if($emailCount != 0) {
                $errors[] = ' Adresa de email exista deja ';
            }

        // Verificare nume
            $char_name = substr($name,0,1);
            
            if(!empty($name) && preg_match("/([A-Z])|([a-z])$/",$char_name[0]) == 0){

                $errors[] = ' Nu este acceptat formatul numelui trebuie sa inceapa cu o litera mare sau mica';

            }
            if(!empty($name)){
                $name_lower = substr($name,1);
                $name_lower_array = str_split($name_lower);
                foreach($name_lower_array as $char){
                    if(preg_match("/([a-z])|([ ])|([,])|(['])$/",$char) == 0){

                        $errors[] = " Nu este acceptat formatul numelui sunt acceptate liere mici si caracterele space , '";
                        break;
                    }
                }
            }
            
        // Verificare username
            if(!empty($username) && preg_match("/([A-Z])|([1-9])|([_])$/",$username) == 0){
                $errors[] = " Username trebuie sa contina litere, cifre sau underscore. ";
                // var_dump($errors);
                // die();
            }
            
        // Verificare parola
            if(strlen($password) < 4) {
                $errors[] = ' Parola trebuie sa aiba minim 4 caractere. ';
            }
          
            if(preg_match('/([A-Z])|([1-9])$/',$password) == 0 ) {
                $errors[] = ' Parola trebuie sa contina, o litera mare sau o cifra. ';
            }
            
            if($password != $confirm) {
                $errors[] = ' Parolele nu se potrivesc. ';
            }

        // Validre email
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $errors[] = ' Trebuie sa introduci o adresa de email valida. ';
            }

        // Afisare errori
            if(!empty($errors)) {
                echo dysplay_errors($errors);
            } else {
            /*
            **Adauga utilizator
            */
            //Cripatre parola 
                $hashed = password_hash($password,PASSWORD_DEFAULT);

            // Inserare in baza de date
                $db->query("INSERT INTO users (full_name, email, password,username) 
                            VALUES('$name','$email','$hashed','$username')");

            // Redirectionare cu mesaj de success
                $_SESSION['success_flash'] = 'Utilizatorul a fost adaugat va rugam sa va conectati';
                header("Location: index.php");
            }
        }
?>
    <h2 class="text-center">Inscrie-te</h2>
    <hr>
    <form action="register.php" method="post">
        <div class="form-group col-md-6">
            <label for="name">Nume complet:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
        </div>
        <div class="form-group col-md-6">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="form-control" value="<?=$username;?>">
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
        
        <div class="form-group col-md-6 text-right" style="margin-top:25px">
            <a href="index.php" class="btn btn-default">login</a>
            <input type="submit" value="Adauga utilizator" class="btn btn-primary">
        </div>
    </form>
    <?php include 'includes/footer.php';?>