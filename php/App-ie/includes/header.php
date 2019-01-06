<?php require_once('core/init.php'); ?>
<?php include_once('includes/header.php'); ?>
<?php include_once('helpers/helpers.php'); ?>
<?php 

$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
$pquery_mobile = $db->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>ie</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/ie.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<!--=======================for product========================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- Header -->
	<header class="header1" id="header_change">
		<!-- Header desktop -->
		<div class="container-menu-header">
			<div class="wrap_header">
				<!-- Logo -->
				<a href="index.php" class="logo">
					<img src="images/icons/logo.png" alt="IMG-LOGO">
				</a>

				<!-- Menu -->
				<div class="wrap_menu" >
					<nav class="menu">
						<ul class="main_menu">
							<?php while($parent = mysqli_fetch_assoc($pquery)): ?>
								
								<li><a href="product.php?cat=<?=$parent['id']?>"><?=$parent['category']?></a>
								<?php 
									$parent_id = $parent['id'];
									$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
									$cquery = $db->query($sql2);
									$count = mysqli_num_rows($cquery);
								?>

									<?php if($count > 0):?>
									<ul class="sub_menu">
										<?php while($chid_cat = mysqli_fetch_assoc($cquery)):?>
											<li><a href="product.php?cat=<?=$chid_cat['id']?>"><?=$chid_cat['category']?></a></li>
										<?php endwhile;?>
									</ul>
									<?php endif;?>
									
								</li>
							<?php endwhile;?>							
						</ul>
					</nav>
				</div>
			<!-- Header Icon -->
				<div class="header-icons">
					

					<span class="linedivide1"></span>
					<div id="change_cart" class="header-wrapicon2">
<?php
if($cart_id != ''):?>
<?php
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'], true); 
    $i = 0;
	$total = 0;
	foreach($items as $cout_item) {
		$i++;
	}
?>
					
						<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti"><?=$i;?></span>
						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
<?php
	foreach($items as $item):?>
	<?php
		$product_id = $item['id'];
		$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
		$product_cart = mysqli_fetch_assoc($productQ);
		$sArray = json_decode($product_cart['sizes']);
	?>					
									<li class="header-cart-item">
									<a href="includes/delete-product.php?edit_id=<?= $product_cart['id']; ?>&edit_size=<?= $item['size']; ?>" class="header-cart-item-name">
										<div class="header-cart-item-img">
											<img src="images/products/<?= $product_cart['cover_img']; ?>" alt="IMG">
										</div>
									</a>
										<div class="header-cart-item-txt">
											<a href="product-detail.php?prod=<?= $product_cart['id']; ?>" class="header-cart-item-name">
												<?= $product_cart['title']; ?>
											</a>

											<span class="header-cart-item-info">
											<?= $item['quantity']; ?> x <?= $product_cart['price']; ?> LEI <?= $item['size']; ?>
											<?php $total += $item['quantity'] * $product_cart['price']?>
											</span>
										</div>
									</li>
<?php endforeach;?>
								</ul>
							<div class="header-cart-total">
								Total: <?= $total; ?> LEI
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>			
							</div>
						</div>
					
<?php else:?>
				<div class="change_cart" class="header-wrapicon2">
						<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti">0</span>
						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
								<li class="header-cart-item">
									<div class="header-cart-item-txt">
										<div class="header-cart-item-name">
												Cosul de cumparaturi este gol
										<div>
									</div>
								</li>
							</ul>
						</div>
					</div>
<?php endif;?>

				</div>
			</div>
		</div>
	</div>
		<!-- Header Mobile -->
		<div class="wrap_header_mobile">
			<!-- Logo moblie -->
			<a href="index.html" class="logo-mobile">
				<img src="images/icons/logo.png" alt="IMG-LOGO">
			</a>

			<!-- Button show menu -->
			<div class="btn-show-menu">
				<!-- Header Icon mobile -->
				<div class="header-icons-mobile">
					

					<span class="linedivide2"></span>
<?php
if($cart_id != ''):?>
	<?php
		$cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
		$result = mysqli_fetch_assoc($cartQ);
		$items = json_decode($result['items'], true); 
		$i = 0;
		$total = 0;
		foreach($items as $cout_item) {
			$i++;
		}
	?>
					<div class="header-wrapicon2">
						<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
						<span class="header-icons-noti"><?=$i;?></span>

						<!-- Header cart noti -->
						<div class="header-cart header-dropdown">
							<ul class="header-cart-wrapitem">
<?php foreach($items as $item):?>
	<?php
		$product_id = $item['id'];
		$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
		$product_cart = mysqli_fetch_assoc($productQ);
	?>	
								<li class="header-cart-item">
									<a href="includes/delete-product.php?edit_id=<?= $product_cart['id']; ?>&edit_size=<?= $item['size']; ?>" class="header-cart-item-name">	
										<div class="header-cart-item-img">
											<img src="images/products/<?= $product_cart['cover_img']; ?>" alt="IMG">
										</div>
									</a>
									<div class="header-cart-item-txt">
										<a href="product-detail.php?prod=<?= $product_cart['id']; ?>" class="header-cart-item-name">
											<?= $product_cart['title']; ?>
										</a>

										<span class="header-cart-item-info">
										<?= $item['quantity']; ?> x <?= $product_cart['price']; ?> LEI <?= $item['size']; ?>
										<?php $total += $item['quantity'] * $product_cart['price']?>
										</span>
									</div>
								</li>	
					<?php endforeach;?>							
							</ul>

							<div class="header-cart-total">
								Total: <?= $total; ?> LEI
							</div>

							<div class="header-cart-buttons">
								<div class="header-cart-wrapbtn">
									<!-- Button -->
									<a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
										View Cart
									</a>
								</div>

							
							</div>
						</div>

					</div>
	<?php else:?>
			
					<div class="header-cart header-dropdown">
						<ul class="header-cart-wrapitem">
							<li class="header-cart-item">
								<div class="header-cart-item-txt">
										<span class="header-cart-item-info">
										Cosul de cumparaturi este gol
										</span>
									</div>			
							</li>
						</ul>
					</div>
	<?php endif;?>
				</div>

				<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</div>
			</div>
		</div>

		<!-- Menu Mobile -->
		<div class="wrap-side-menu" >
			<nav class="side-menu">
				<ul class="main-menu">
					<li class="item-topbar-mobile p-l-10">
						<div class="topbar-social-mobile">
							<a href="#" class="topbar-social-item fa fa-facebook"></a>
							<a href="#" class="topbar-social-item fa fa-instagram"></a>
							<a href="#" class="topbar-social-item fa fa-youtube-play"></a>
						</div>
					</li>
				
					<?php while($parent = mysqli_fetch_assoc($pquery_mobile)): ?>
					<li class="item-menu-mobile">
						<a href="product.php?cat=<?=$parent['id']?>"><?=$parent['category']?></a>
						<?php 
							$parent_id = $parent['id'];
							$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
							$cquery = $db->query($sql2);
							$count = mysqli_num_rows($cquery);
						?>
						<?php if($count > 0):?>
							<ul class="sub-menu">
								<?php while($chid_cat = mysqli_fetch_assoc($cquery)):?>
								<li><a href="product.php?cat=<?=$chid_cat['id']?>"><?=$chid_cat['category']?></a></li>
								<?php endwhile;?>
							</ul>
							<i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
						<?php endif;?>
					</li>
					<?php endwhile;?>
				</ul>
			</nav>
		</div>
	</header>