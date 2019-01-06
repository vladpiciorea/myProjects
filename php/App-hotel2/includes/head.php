<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
     <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <script src="https://code.jquery.com/jquery-2.1.2.min.js"
            integrity="sha256-YE7BKn1ea9jirCHPr/EaW5NxmkZZGb52+ZaD2UKodXY="
            crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="wrapper">
        <div class="overlay"></div>  
        <!-- Navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <?php if(logged_in()):?>
                        <a href="#">
                            Salut  <?=$user_data['username'];?>
                        </a>
                    <?php else: ?>
                        <a href="#">
                            Salut
                        </a>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <?php if(!logged_in()):?>
                <li>
                    <a href="register.php">Inscrie-te</a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="contact.php">Contact</a>
                </li>
                <?php if(logged_in()):?>
                    <li>
                        <a href="reservation.php">Rezervare</a>
                    </li>
                    <li>
                        <a href="logout.php">Log Out</a>
                    </li>
                <?php endif; ?>
                
            </ul>
        </nav>