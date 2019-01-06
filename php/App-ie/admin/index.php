<?php
    require_once '../core/init.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/ie/helpers/helpers.php';
    if(!is_logged_in()) {
        header('Location: login.php');
    }
   
    include 'includes/head.php';
    include 'includes/navigation.php';  
?>
Admin Home
<?php include 'includes/footer.php';?>