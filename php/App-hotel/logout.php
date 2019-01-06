<?php
    require_once './core/init.php';
// Distrugere sesiune
    unset($_SESSION['SBUser']);
    header('Location: index.php');
?>