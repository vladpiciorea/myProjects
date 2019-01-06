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

// Login cu inserare ultimei logari
    function login($user_id) {
        $_SESSION['SBUser'] = $user_id;
        global $db;
        $date = date("Y-m-d H:i:s");
        $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id' ");
        $_SESSION['success_flash'] = 'Esti logat';
        header('Location: index.php');

    }
// Verificare daca este logat
    function is_logged_in () {


        if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0) {
            return true;
        }else {
            return false;
        }
    }

//Mesaj redirectionare
    function login_error_redirect($url = 'index.php') {

        $_SESSION['error_flash'] = 'Trebuie sa te loghezi pentru a accesa continutul pagini';
        header('Location: '.$url);
    }
