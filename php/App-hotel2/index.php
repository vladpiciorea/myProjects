<?php
    require_once './core/init.php';  
    include './includes/head.php';

// Captare date intrare
    $email = ((isset($_POST['email'])) ? trim($_POST['email']) : '');
    $password = ((isset($_POST['password'])) ? trim($_POST['password']) : '');
    
?>
    <?php if(!logged_in()):?>
    <style>
    body{
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

                            if(empty($_POST['email']) || empty($_POST['password'])) {

                                // Verificare complatare email si parola
                                echo ' Trebuie sa introduci emailul si parola.';

                            }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

                                // Verificare mail
                                echo ' Trebuie sa introduci o adresa de email corecta.';

                            }elseif(strlen($password) < 4){

                                // Verificare lungime password
                                echo " Parola trebuie sa aiba minim 4 carcatere.";

                            }else{
                                // Verificare daca email exista in db
                                $query = $db->query("SELECT * FROM users WHERE email = '$email'");
                                $user = mysqli_fetch_assoc($query);
                                $userCount = mysqli_num_rows($query);

                                if($userCount < 1) {

                                    echo 'Adresa de email nu exista. <br>';

                                }elseif($password != $user['password']){

                                    // Verificare parola
                                    echo ' Parola nu este corecta <br>';

                                }else{

                                    $user_id = $user['id'];
                                    login($user_id);
                                }
                            }  
                        } 
                    ?>
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
                        
                    </div>               
            </div>
        </div>
    </div>
    <?php else: ?>

    <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
    			<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
            </button>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h1>Homepage</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic quae provident velit tempora neque quos earum, porro placeat, distinctio, molestiae modi voluptas enim delectus? Eos facere ratione perspiciatis voluptatibus enim.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic quae provident velit tempora neque quos earum, porro placeat, distinctio, molestiae modi voluptas enim delectus? Eos facere ratione perspiciatis voluptatibus enim.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic quae provident velit tempora neque quos earum, porro placeat, distinctio, molestiae modi voluptas enim delectus? Eos facere ratione perspiciatis voluptatibus enim.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic quae provident velit tempora neque quos earum, porro placeat, distinctio, molestiae modi voluptas enim delectus? Eos facere ratione perspiciatis voluptatibus enim.</p>
                        
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <?php include 'includes/footer.php';?>