<?php
	require_once('core/init.php');
	include_once('includes/header.php');
	include_once('helpers/helpers.php');
	
	$cat_id = (isset($_GET['cat']))? (int)$_GET['cat'] : '';

/*
    Database
*/

	$product = disply_product($cat_id);
	$sql = "SELECT * FROM products WHERE $product AND  deleted != 1";
	$products = $db->query($sql);	

?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" style="background-image: url(images/title_page_Ii_traditionale.jpg);">
		<h2 class="l-text2 t-center">
			<!-- Incarca dinamic titlul paginii -->
			<?php $parent = $db->query("SELECT * FROM categories WHERE id = '$cat_id'");
			$result = mysqli_fetch_assoc($parent);
			echo $result['category']; ?>
		</h2>
	</section>


	<!-- Content page -->
	<!-- Filters -->
	<!--===============================================================================================-->
	<?php include('includes/filters.php');?>
	<!--===============================================================================================-->
					<!-- Product -->
					<div class="row " id="change">
					<?php if($cat_id != 0):?>
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
					</div>
					<input type="hidden" name="cat_id" id="cat_id" value="<?=$cat_id?>">

					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
						<a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>
						<a href="#" class="item-pagination flex-c-m trans-0-4">2</a>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
include ('includes/footer.php');
?>


