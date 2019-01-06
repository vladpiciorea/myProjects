<?php

    require_once('../core/init.php');
    include_once('../helpers/helpers.php');
    $id_product = (int)$_POST['id_produt'];
    $num_product =(int)$_POST['num_product'];
    $size_product = sanitize($_POST['size_product']);

    $available = '';
    $sql = "SELECT * FROM products WHERE id='$id_product'";
	$products = $db->query($sql);
    $product= mysqli_fetch_array($products);
    
    $sizes = json_decode($product['sizes'], true);

    foreach($sizes as $size => $qan ){
								
        if($size_product == $size) {	
                $available = $qan;
                break;
            }
        }


    $item = array();
    $item[] = array(
            'id' => $id_product,
            'size' => $size_product,
            'quantity' => $num_product,
    );



//  Chech if the car cookie exist
if($cart_id != '') {
        
        $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
        $cart = mysqli_fetch_assoc($cartQ);
        $previous_items = json_decode($cart['items'], true);
        $item_match = 0;
        $new_items = array();


    foreach($previous_items AS $pitem) {

        if($item[0]['id'] == $pitem['id'] && $item[0]['size'] == $pitem['size']) {
            $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
            if($pitem['quantity'] > $available) {
                $pitem['quantity'] = $available;
            }

        $item_match = 1;
        }
        $new_items[] = $pitem;
    }


    if($item_match != 1) {
            $new_items = array_merge($item, $previous_items);
    }

        $items_json = json_encode($new_items);
        $cart_expire = date("Y-m-d H:i:s", strtotime("+30 days"));

        $db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id = '{$cart_id}'");
        setcookie(CART_COOKIE, '', 1, '/', false, false);
        setcookie(CART_COOKIE, $cart_id, CART_COOKIE_EXPIRE, '/', false, false);
        
    }else {

        if($item[0]['quantity'] > $available) {
            $item[0]['quantity'] = $available;

        }
        

        // add the cart to db and set cookie
        $items_json = json_encode($item);
        $cart_expire = date("Y-m-d H:i:s", strtotime("+30 days"));
        $db->query("INSERT INTO cart(items, expire_date) VALUES ('{$items_json}', '{$cart_expire}')");
        $cart_id = $db->insert_id;
        setcookie(CART_COOKIE, $cart_id, CART_COOKIE_EXPIRE, '/', false, false);
    }
?>



<?php 

$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
$pquery_mobile = $db->query($sql);

?>

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
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

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
									
										<div class="header-cart-item-img">
											<img src="images/products/<?= $product_cart['cover_img']; ?>" alt="IMG">
										</div>
									
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
					<a href="#" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

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
									<div class="header-cart-item-img">
										<img src="images/products/<?= $product_cart['cover_img']; ?>" alt="IMG">
									</div>
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
