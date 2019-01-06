<?php 
session_start();
unset($_SESSION['name']);//sterge o variabila din sesion
session_destroy(); //sterge toate var din sesion
?>