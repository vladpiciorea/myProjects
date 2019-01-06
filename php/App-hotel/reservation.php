<?php
    require_once './core/init.php';
    include_once './helpers/helpers.php';

// Verificare daca userul nu este logat 
    if(!is_logged_in()) {
        login_error_redirect();
    } 
    include './includes/head.php';
    include './includes/navigation.php';

// Sanitizare date intrare
    $room = ((isset($_POST['room']))? (int)$_POST['room'] : '');
    $night = ((isset($_POST['night']))? (int)$_POST['night'] : '');
    $pay = ((isset($_POST['pay']))? (int)$_POST['pay'] : '');
    $rate = ((isset($_POST['rate']) && $_POST['rate'] != 0)? (int)$_POST['rate'] : 1);
    
    $errors = array();

        if($_POST) {

        // Verificare completare input
            $required = array('room', 'night', 'pay');
            foreach($required as $f) {
                if(empty($_POST[$f])) {
                    $errors[] = ' Trebuie sa completezi toate casutele';
                    break;
                }
            }
            if(!empty($errors)) {
                echo dysplay_errors($errors);
            } else {

            // Calculul ratei
                if($rate == 1){
                    if($room == 1){
                        $to_pay = (150*$night)/$rate;      
                    }else{
                        $to_pay = (100*$night)/$rate;
                    }
                }else{
                    if($room == 1){
                        $to_pay = (150*$night)/$rate;      
                    }else{
                        $to_pay = (100*$night)/$rate;
                    }
                }
            // Inserare in baza de date


            // Redirectionare cu mesaj de success
                $_SESSION['success_flash'] = 'Cererea a fost inregistrata si aveti de plata ' . $to_pay . ' in '. $rate . ' rata';
                header("Location: index.php");
            }
        }
?>
    <h2 class="text-center">Rezerva</h2>
        <h2 class="text-center">Camera single 100lei pe noapte</h2>
        <h2 class="text-center">Camera double 150lei pe noapte</h2>
    <hr>
    <form action="reservation.php" method="post">
        
        <div class="form-group col-md-9">
            <label for="room">Tip de camera :</label>
            <select name="room" class="form-control" id="room">
                    <option value="1">Dubla</option>
                    <option value="2">Singel</option>          
            </select>
        </div>
        <div class="form-group col-md-9">
            <label for="night">Numar de nopti:</label>
            <input type="number" name="night" id="night" class="form-control">
        </div>
        <div class="form-group col-md-9">
            <label for="pay">Modalitate de plata :</label>
            <select name="pay" class="form-control" id="pay">
                    <option value="1">Integral</option>
                    <option value="2">Rate</option>          
            </select>
        </div>
        <div class="form-group col-md-9" id = 'rate_number'>
            <label for="rate">Numar de rate:</label>
            <input type="number" name="rate" id="rate" class="form-control" value="0">
        </div>
  
        <div class="form-group col-md-6 text-right" style="margin-top:25px">
            <a href="index.php" class="btn btn-default">Hompege</a>
            <input type="submit" value="Inregistreaza cererea" class="btn btn-primary">
        </div>
    </form>
    <script>
    jQuery('#rate_number').css("display","none");
    jQuery('#pay').change(function(){
		var pay = jQuery('#pay option:selected').val()
        if(pay == 2) {

			jQuery('#rate_number').css("display","block");
		} else {
			jQuery('#rate_number').css("display","none");
		}
		
    });
    </script>
    <?php include 'includes/footer.php';?>