<?php
    require_once './core/init.php';
    include_once './helpers/helpers.php';   
    include './includes/head.php';
    include './includes/navigation.php';
    // Verificare daca userul este logat
    $user = array('full_name' => '', 'email' => '');
    if(is_logged_in()) {
        $id = $_SESSION['SBUser'];
        $query_id = $db->query("SELECT * FROM users WHERE id = '$id'");
        $user = mysqli_fetch_assoc($query_id);
    } 
    
    // Sanitizare date intrare
    $name = ((isset($_POST['name']))? sanitize($_POST['name']) : $user['full_name']);
    $email = ((isset($_POST['email']))? sanitize($_POST['email']) : $user['email']);
    $source = ((isset($_POST['source']))? sanitize($_POST['source']) : '');
    $phone_numb = ((isset($_POST['phone_numb']))? sanitize($_POST['phone_numb']) : '');
    $question = ((isset($_POST['question']))? sanitize($_POST['question']) : '');
    $errors = array();

        if($_POST) {
            
        // Verificare completare input
            $required = array('name', 'email', 'phone_numb', 'question');
            foreach($required as $f) {
                if(empty($_POST[$f])) {
                    $errors[] = ' Trebuie sa completezi toate casutele';
                    break;
                }
            }

        // Verificare nume
            $char_name = substr($name,0,1); 
            if(!empty($name) && preg_match("/([A-Z])|([a-z])$/",$char_name[0]) == 0){

                $errors[] = ' Nu este acceptat formatul numelui trebuie sa inceapa cu o litera mare sau mica';

            }

            $char_lower = substr($name,1);
           
            if(!empty($name) && preg_match("/([a-z])|([ ])|([,])$/",$char_lower) == 0){
                $errors[] = " Nu este acceptat formatul numelui sunt acceptate liere mici si caracterele space , '";
        
            }

        // Verificare numar de telefon
            if(!empty($phone_numb)){

                $phone_numb_first = substr($phone_numb,0,1);
                $phone_numb_prefix = substr($phone_numb,0,2); 

                if($phone_numb_first == 0) {
                   
                    if(strlen($phone_numb) != 10) {
                        $errors[] = ' Telefonul trebuie sa aiba 10 caractere';
                        var_dump($errors);
                        die(); 
                    }
                }else{

                    if($phone_numb_prefix != 40) {

                        $errors[] = ' Numar de telefon nvalid';                            
                    }
                } 
                
            }

        // Verificare email 
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $errors[] = ' Trebuie sa introduci o adresa de email valida';
            }

            if(!empty($errors)) {
                echo dysplay_errors($errors);
            } else {

            // Inserare in baza de date       
                

            // Redirectionare cu mesaj de success
                $_SESSION['success_flash'] = 'Cererea a fost inregistrata';
                header("Location: index.php");
            }
        }
?>
    <h2 class="text-center">Contacteaza-ne</h2>
    <hr>
    <form action="contact.php" method="post">
        <div class="form-group col-md-9">
            <label for="name">Nume:</label>
            <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>">
        </div>
        <div class="form-group col-md-9">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
        </div>
        <div class="form-group col-md-9">
            <label for="source">De unde ati auzit de hotel :</label>
            <select name="source" class="form-control" id="source">
                    <option value="1">Prieten</option>
                    <option value="2">Google</option>
                    <option value="3">Alta sursa</option>           
            </select>
        </div>
        <div class="form-group col-md-9">
            <label for="phone_numb">Telefon:</label>
            <input type="number" name="phone_numb" id="phone_numb" class="form-control" value="<?=$phone_numb;?>">
        </div>
        <div class="form-group col-md-9">
            <label for="question">Intrebare:</label>
            <textarea name="question" class="form-control" id="question"  ><?=$question;?></textarea>
        </div>
  
        <div class="form-group col-md-6 text-right" style="margin-top:25px">
            <a href="index.php" class="btn btn-default">Hompege</a>
            <input type="submit" value="Inregistreaza cererea" class="btn btn-primary">
        </div>
    </form>
    <?php include 'includes/footer.php';?>