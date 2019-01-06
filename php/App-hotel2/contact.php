<?php
    require_once './core/init.php';  
    include './includes/head.php';

    // Verificare daca userul este logat
    $user = array('full_name' => '', 'email' => '');
    if(logged_in()) {
        $id = $_SESSION['User'];
        $query_id = $db->query("SELECT * FROM users WHERE id = '$id'");
        $user = mysqli_fetch_assoc($query_id);
    } 
    
    // Sanitizare date intrare
    $name = ((isset($_POST['name']))? trim($_POST['name']) : $user['full_name']);
    $email = ((isset($_POST['email']))? trim($_POST['email']) : $user['email']);
    $source = ((isset($_POST['source']))? trim($_POST['source']) : '');
    $phone_numb = ((isset($_POST['phone_numb']))? trim($_POST['phone_numb']) : '');
    $question = ((isset($_POST['question']))? trim($_POST['question']) : '');

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
                                if(empty($_POST['email']) || empty($_POST['phone_numb']) || empty($_POST['name']) || empty($_POST['question'])) {

                                    // Verificare complatare email si parola
                                    echo ' Trebuie sa completezi toate casutel.';

                                }elseif(preg_match("/([A-Z])|([a-z])$/",substr($name,0,1)) == 0){

                                    // Verificare nume
                                    echo ' Nu este acceptat formatul numelui trebuie sa inceapa cu o litera mare sau mica';
                    
                                }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {

                                    // Verificare email 
                                    echo' Trebuie sa introduci o adresa de email valida';

                                } else{
                                    
                                        // Verificare numar de telefon
                                        $phone_first = substr($phone_numb,0,1);
                                        $phone_prefix = substr($phone_numb,0,2);
                                        $error = '';

                                        if($phone_first == 0) {
                                        
                                            if(strlen($phone_numb) != 10) {

                                                $error = ' Telefonul trebuie sa aiba 10 caractere';
                                            }
                                        }elseif($phone_prefix != 40) {
                        
                                                $error =' Numar de telefon nvalid';                            
                                        }else{}
                                            
                                            
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
                                               

                                            // Redirectionare cu mesaj de success
                                                $_SESSION['success'] = 'Cererea a fost inregistrata';
                                                header("Location: index.php");
                                            }

                                        }    
                                    }      

                                     
                        ?>
                        <h2 class="text-center">Contacteaza-ne</h2>
                        <hr>
                        <form action="contact.php" method="post">
                            <div class="form-group">
                                <label for="name">Nume:</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
                            </div>
                            <div class="form-group ">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
                            </div>
                            <div class="form-group ">
                                <label for="source">De unde ati auzit de hotel :</label>
                                <select name="source" class="form-control" id="source">
                                    <option value="1">Prieten</option>
                                    <option value="2">Google</option>
                                    <option value="3">Alta sursa</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="phone_numb">Telefon:</label>
                                <input type="number" name="phone_numb" id="phone_numb" class="form-control" value="<?=$phone_numb;?>">
                            </div>
                            <div class="form-group">
                                <label for="question">Intrebare:</label>
                                <textarea name="question" class="form-control" id="question">
                                    <?=$question;?>
                                </textarea>
                            </div>

                            <div class="form-group text-right" style="margin-top:25px">
                                <a href="index.php" class="btn btn-default">Hompege</a>
                                <input type="submit" value="Inregistreaza cererea" class="btn btn-primary">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php';?>