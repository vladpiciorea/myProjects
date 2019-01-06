<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <a href="index.php" class="navbar-brand">Homepage</a>
                <ul class="nav navbar-nav">
                <!-- Verificare daca nu este logat -->
                <?php if(!is_logged_in()):?>
                <li><a href="register.php">Inscrie-te</a></li>
                <?php endif; ?>
                <li><a href="contact.php">Contact</a></li>

                <!-- Verificare daca este logat -->
                <?php if(is_logged_in()):?>
                    <li><a href="reservation.php">Rezervare</a></li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Salut <?=$user_data['username'];?> !
                    <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">

                        <li><a href="logout.php">Log Out</a></li>

                    </ul>
                </li>
                <?php endif; ?>
                    
                </ul>
        </div>
    </nav>