<?php
    require_once './core/init.php';
// Distrugere sesiune
    unset($_SESSION['User']);
    header('Location: index.php');
?>