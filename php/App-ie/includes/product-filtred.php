<?php
    require_once '../core/init.php';
	include '../helpers/helpers.php';
/*
    Variabile
*/	
    $cat_id = ((isset($_POST['cat_id']))? (int)$_POST['cat_id'] : 0);
    $price_min = (int)$_POST['price_min'];
    $price_max = (int)$_POST['price_max'];
    $blue = (int)$_POST['blue'];
    $red = (int)$_POST['red'];
    $black = (int)$_POST['black'];
	$value = ((isset($_POST['value']))? (int)$_POST['value'] : 0);


/*
    Database
*/
    $product = disply_product($cat_id, $price_min,$price_max,$value,$blue,$red,$black);
	$sql = "SELECT * FROM products WHERE  deleted != 1 AND $product";


    // echo $sql;
    $products = $db->query($sql);


?>
<?php if($cat_id > 0): ?>
<?php while($product = mysqli_fetch_assoc($products)):?>
		<div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-img wrap-pic-w of-hidden pos-relative">
							<img src="images/products/<?=$product['cover_img']?>" alt="IMG-PRODUCT">
						
						 <div class="block2-overlay trans-0-4">
							<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
								<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
								<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
							</a>
							<div class="product w-size1 trans-0-4" style='bottom: -45px; 
																		align-items: center;padding-top: 100%;
																		padding-top: 100%;
																		margin: auto;'>
								<!-- Button -->
								<a href="product-detail.php?prod=<?=$product['id']?>">
									<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
										Vezi detalii
									</button>
								</a>
							</div>
					</div>
				</div>

				<div class="block2-txt p-t-20">
					<a href="product-detail.php?prod=<?=$product['id']?>" class="block2-name dis-block s-text3 p-b-5">
					    <?=$product['title']?>
						</a>
						<span class="block2-price m-text6 p-r-5">
							<?=$product['price']?>
						</span>
					</div>
				</div>
		    </div>
<?php endwhile;?>
<?php endif;?>
<input type="hidden" name="sorteaza" id="price_min" value= "<?= $price_min;?>">
<input type="hidden" name="sorteaza" id="price_max" value= "<?= $price_max;?>">