<?php
   require_once '../core/init.php';
   include '../helpers/helpers.php';
   $num_product = '';
    $size_product = $_POST['size_product'];
    $id_prod = $_POST['id_prod'];
    $mode = $_POST['mode'];
    $num_product = $_POST['num_product'];




    // var_dump($size_product);

    $sql = "SELECT * FROM products WHERE id='$id_prod'";
	$products = $db->query($sql);
	$product= mysqli_fetch_array($products);
    $sizes = json_decode($product['sizes'], true);

    $size_db = '';
    $quan_db ;
    
    foreach($sizes as $size => $qan ){
								
        if($size_product == $size) {	
                $size_db = $size;
                $quan_db = $qan;
                break;
            }
        }



    if($size_product == '0' ) {
        echo $size_product;
    }else {
        if( $size_product == $size_db) {
            if($num_product  <=  $quan_db - 1 ) {
                echo 'add';
            }else {
               
                echo '1';
            }
        }
    }
    unset($num_product);

?>