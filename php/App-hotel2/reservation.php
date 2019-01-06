<?php
    require_once './core/init.php';

// Verificare daca userul nu este logat 
    if(!logged_in()) {
        login_error();
    } 
    include './includes/head.php';


// Sanitizare date intrare
    $room = ((isset($_POST['room']))? (int)$_POST['room'] : '');
    $night = ((isset($_POST['night']))? (int)$_POST['night'] : '');
    $pay = ((isset($_POST['pay']))? (int)$_POST['pay'] : '');
    $rate = ((isset($_POST['rate']) && $_POST['rate'] != 0)? (int)$_POST['rate'] : 1);
    
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
                        <?php if($_POST) {

                        // Verificare completare input
                        // Verificare completare input
                        if(empty($_POST['room']) || empty($_POST['night']) || empty($_POST['pay'])) {

                            // Verificare complatare email si parola
                            echo ' Trebuie sa completezi toate casutel.';
                           
                        } else {

                            // Calculul ratei
                                if($rate == 1){
                                    if($room == 1){
                                        $to_pay = (150*$night)/$rate;      
                                    }else{
                                        $to_pay = (100*$night)/$rate;
                                    }
                                }else{
                                    if($romm == 1){
                                        $to_pay = (150*$night)/$rate;      
                                    }else{
                                        $to_pay = (100*$night)/$rate;
                                    }
                                }
                            
                            // Redirectionare cu mesaj de success
                                $_SESSION['success'] = 'Cererea a fost inregistrata si aveti de plata ' . $to_pay . ' in '. $rate . ' rata';
                                header("Location: index.php");
                            }
                        }
                        ?>
                        <h2 class="text-center">Rezerva</h2>
                        <h2 class="text-center col-lg-6">Camera single 100 lei/noapte</h2>
                        <h2 class="text-center col-lg-6">Camera double 150 lei/noapte</h2>
                        <hr>
                        <form action="reservation.php" method="post">

                            <div class="form-group">
                                <label for="room">Tip de camera :</label>
                                <select name="room" class="form-control" id="room">
                                    <option value="1">Dubla (150 lei/noapte)</option>
                                    <option value="2">Singel (100lei/noapte)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="night">Numar de nopti:</label>
                                <input type="number" name="night" id="night" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="pay">Modalitate de plata :</label>
                                <select name="pay" class="form-control" id="pay">
                                    <option value="1">Integral</option>
                                    <option value="2">Rate</option>
                                </select>
                            </div>
                            <div class="form-group" id ='rate_number'>
                                <label for="rate">Numar de rate:</label>
                                <input type="number" name="rate" id="rate" class="form-control" value="0">
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