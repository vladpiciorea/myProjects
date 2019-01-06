<?php
    require_once './core/init.php';
    include './includes/head.php';
// Verificare daca userul este logat
    if(logged_in()) {
        login_error();
    } 

// Sanitizare date intrare
    $name = ((isset($_POST['name']))? trim($_POST['name']) : '');
    $username = ((isset($_POST['username']))? trim($_POST['username']) : '');
    $email = ((isset($_POST['email']))? trim($_POST['email']) : '');
    $password = ((isset($_POST['password']))? trim($_POST['password']) : '');
    $confirm = ((isset($_POST['confirm']))? trim($_POST['confirm']) : ''); 
?>
    <style>
        body {
            background-image: url(images/login_bg.jpg);
            background-size: 100vw 100vh;
            background-attachment: fixed;
        }
    </style>
    <div id="page-content-wrapper">
        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ">
                    <div id="login-form">
                        <?php
                        if($_POST) {

                            // Verificare completare input
                            if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['name']) || empty($_POST['confirm'])) {

                                // Verificare complatare email si parola
                                echo ' Trebuie sa completezi toate casutel.';
                               
                            }elseif( preg_match("/([A-Z])|([a-z])$/",substr($name,0,1)) == 0){
                                
                                // Verificare prima litera
                                echo' Formatul numelui nu este acceptat trebuie sa inceapa cu o litera mare sau mica';
                
                            }elseif(!empty($username) && preg_match("/([A-Z])|([1-9])|([_])$/",$username) == 0){

                                // Verificare username
                                echo " Username trebuie sa contina litere, cifre sau underscore. ";
                                
                            }elseif(strlen($password) < 4) {
                                
                                // Verificare parola
                                echo ' Parola trebuie sa aiba minim 4 caractere. ';

                            }elseif(preg_match('/([A-Z])|([1-9])$/',$password) == 0 ) {

                                // Verificare parola
                                echo ' Parola trebuie sa contina, o litera mare sau o cifra. ';

                            }elseif($password != $confirm) {
                                // Verificare parola confirm
                                echo ' Parolele nu se potrivesc. ';

                            }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {

                                // Validre email
                                echo' Trebuie sa introduci o adresa de email valida. ';
                            }else{

                            // Verificare duplicat email
                                $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
                                $emailCount = mysqli_num_rows($emailQuery);

                                if($emailCount != 0) {
                                    echo ' Adresa de email exista deja ';
                                }else{
                                    $error = '';
                                    $name_lower = substr($name,1);
                                    $name_lower_array = str_split($name_lower);
                                    foreach($name_lower_array as $char){
                                        if(preg_match("/([a-z])|([ ])|([,])|(['])$/",$char) == 0){
                    
                                            $error = " Nu este acceptat formatul numelui sunt acceptate liere mici si caracterele space , '";
                                            break;
                                        }   
                                    }
                                    if(!empty($error)){
                                        echo $error;
                                    }else{

                                    
                                    // Inserare in baza de date
                                        $db->query("INSERT INTO users (full_name, email, password,username) 
                                                    VALUES('$name','$email','$password','$username')");
                        
                                    // Redirectionare cu mesaj de success
                                        $_SESSION['success'] = 'Utilizatorul a fost adaugat va rugam sa va conectati';
                                        header("Location: index.php");

                                    } 
                                    }
                                }
                            }
                            ?>
                        <h2 class="text-center">Inscrie-te</h2>
                        <hr>
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <label for="name">Nume complet:</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
                            </div>
                            <div class="form-group ">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?=$username;?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Emial:</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Parola:</label>
                                <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
                            </div>
                            <div class="form-group">
                                <label for="confirm">Confirmare parola:</label>
                                <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
                            </div>

                            <div class="form-group text-right" style="margin-top:25px">
                                <a href="index.php" class="btn btn-default">login</a>
                                <input type="submit" value="Adauga utilizator" class="btn btn-primary">
                            </div>
                        </form>
                    </div>               
            </div>
        </div>
    </div>
<?php include 'includes/footer.php';?>