<nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <a href="index.php" class="navbar-brand">Home</a>
                <ul class="nav navbar-nav">
                <!-- Menu items -->
                <li><a href="categories.php">Categorii</a></li>
                <li><a href="products.php">Produse</a></li>
                <li><a href="productsarh.php">Produse arhivate</a></li>
                <?php 
                // if(has_permission('admin')):?>
                    <li><a href="users.php">Utilizatori</a></li>
                <?php 
                // endif; ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello!
                    <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="change_password.php">Schimba Parola</a></li>
                        <li><a href="logout.php">Log Out</a></li>

                    </ul>
                </li>
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            
                            <li><a href="products.php">Produse active</a></li>
                            <li><a href="productsarh.php">Produse arhivate></li>
                        </ul>    
                    </li> -->
                </ul>
        </div>
    </nav>