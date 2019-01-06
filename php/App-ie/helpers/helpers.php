<?php

//Functie de sanitize
function sanitize($dirty) {
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

// Afiseaza erorile
function dysplay_errors($erors) {
    $dysplay = '<ul class="bg-danger">';
    foreach($erors as $error) {
        $dysplay .= '<li class="text-danger">'.$error.'</li>';
    }
    $dysplay .= '</ul>';
    return $dysplay;
}

// Afiseaza bani in format lei
function money($number) {
    return number_format($number,2) . ' LEI';
}

// Determina query pentru a afisa produsele
function disply_product($cat_id, $price_min = 0, $price_max = 0, $value = 0, $blue = 0,$red = 0,$black = 0) {
        global $db;
        $product = '';
        if($price_min != 0) {
            $product .= " price > '".$price_min."' AND";
    
        }
    
        if($price_max != 0) {
            $product .= " price < '".$price_max."' AND";
        }

        if($blue != 0 || $red != 0 || $black != 0 ) {
            $product .= ' ( ';
            $product_color = '';
            if($blue != 0 )
            
                $product_color .= " color = '".$blue."' OR";

            if($red != 0) {

                $product_color .= " color = '".$red."' OR";
            }
            if($black != 0) {
                $product_color .= " color = '".$black."' OR";
            }
            $product_color = substr($product_color,0,-2);

            $product .= $product_color. ' ) AND';

        }
    
            if($cat_id != 0) {
                // Face a uniune a tabelului cu el insusi
                $query = "SELECT p.id As 'pid', p.category AS 'category', c.id AS 'cid', c.category AS 'child' FROM categories c 
                INNER JOIN categories p ON c.parent = p.id WHERE p.id = '$cat_id'";
    
                $products_id = $db->query($query);
                $count = mysqli_num_rows($products_id);
    
                // Verifica daca este parine
                if($count != 0){
                    $product .= " (";
                    while($result = mysqli_fetch_assoc($products_id)) {
    
                        $product .= " categories = '".$result['cid']."' OR";
                        $filter_cat = ' current';
                    }
                    $product .= " categories = '".$cat_id."')";
                // echo $product;
                    }else {
                        // Daca nu este parinte atribuie valore get-ului
                        $product .= " categories = '$cat_id'";
                    }
            }
            if($value == 1) {
                $product .= " ORDER BY popularity DESC"; 
            }elseif($value == 2) {
                $product .= " ORDER BY price ASC";
            }elseif($value == 3) {
                $product .= " ORDER BY price DESC";
            }else{
                //     return $product;
            }
        return $product;
    }

// Meniu pentru ecrane mari
function display_menu($parent_id = 0) {
    global $db;
	$query = "SELECT * FROM categories WHERE parent = '$parent_id'";
	$sql_p = $db->query($query);
    $count = mysqli_num_rows($sql_p);
	if($count > 0) {
		if($parent_id != 0) {
            echo '<ul class="sub_menu">';
            while ($categories = mysqli_fetch_assoc($sql_p)){

                $s_menu = '<li><a href="product.php?cat='.$categories['id'].'">'.$categories['category'].'</a>';
                echo $s_menu;
                display_menu($categories['id']);
    
            } 
            echo '</ul>'; 
		}
			

		echo '</li>
			  </ul>';
		}
	}
	
	// Meniu pentru ecrane mici
	function display_menu_m($parent_id = 0) {
		global $db;
		$query = "SELECT * FROM categories WHERE parent = '$parent_id'";
		$sql_p = $db->query($query);
		$count = mysqli_num_rows($sql_p);
		if($count > 0) {
			if($parent_id != 0) {
				echo '<ul class="sub_menu">';  
			}
			
			while ($categories = mysqli_fetch_assoc($sql_p)){
				$parent = $categories['parent'];
				if( $parent == 0 ){
					$s_menu = '<li class="item-menu-mobile"><a href="product.php?cat='.$categories['id'].'">'.$categories['category'].'</a>';
				}else{
					$s_menu = '<li><a href="product.php?cat='.$categories['id'].'">'.$categories['category'].'</a>';
				}
				echo $s_menu;
				display_menu($categories['id']);
				if($parent == 0){
					echo '<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>';
				}
				
			}
	
			echo '<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
				</li>
				</ul>';
			}
        }
        
// Login Admin
    function login($user_id) {
        $_SESSION['SBUser'] = $user_id;
        global $db;
        $date = date("Y-m-d H:i:s");
        $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id' ");
        $_SESSION['success_flash'] = 'Esti logat';
        header('Location: index.php');

    }

    function is_logged_in () {


        if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0) {
            return true;
        }else {
            return false;
        }
    }

    function login_error_redirect($url = 'login.php') {

        $_SESSION['error_flash'] = 'Trebuie sa te loghezi pentru a accesa continutul pagini';
        header('Location: '.$url);
    }

    function permission_error_redirect($url = 'login.php') {
        $_SESSION['error_flash'] = 'Nu ai access la pagina ';
        header('Location: '.$url);
    }
    
    function has_permission($permision = 'admin') {

        global $user_data;
        $permisions = explode(',', $user_data['permissions']);
    // verifica daca permisiunea de admin exista in array facut mai sus permissons
        if(in_array($permision,$permisions,true)) {
            return true;
        } else {
            return false;
        }
    }
    function pretty_date($date) {
        return date("M d, Y h:i A",strtotime($date));
    }