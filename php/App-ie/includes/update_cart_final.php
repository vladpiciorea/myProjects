<?php 
    require_once '../core/init.php';
    include '../helpers/helpers.php';
    $mode = sanitize($_POST['mode']);
    $edit_size = sanitize($_POST['edit_size']);
    $edit_id = sanitize($_POST['edit_id']);
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '$cart_id'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'], true);
    $update_items = array();
    $domanin = (($_SERVER['HTTP_HOST'] != 'localhost')? '.'.$_SERVER['HTTP_HOST'] : false);

    if($mode == 'removeone') {
        foreach($items as $item) {
            if($item['id'] == $edit_id && $item['size'] == $edit_size) {
                $item['quantity'] = $item['quantity'] - 1;
            }
            if($item['quantity'] > 0) {
                $update_items[] = $item;
            }
        }
    }
    if($mode == 'addone') {
        foreach($items as $item) {
            if($item['id'] == $edit_id && $item['size'] == $edit_size) {
                $item['quantity'] = $item['quantity'] + 1;
            }
            $update_items[] = $item;   
        }
    }

    if(!empty($update_items)) {
        $json_update = json_encode($update_items);
        $db->query("UPDATE cart SET items = '{$json_update}' WHERE id = '{$cart_id}'");
        $_SESSION['successs_flash'] = 'Cosul de cumparaturi a fost updatat';
    }

    if(empty($update_items)) {
        $db->query("DELETE FROM cart WHERE id = '{$cart_id}'");
        setcookie(CART_COOKIE, '', 1,"/", $domanin, false);
    }

?>