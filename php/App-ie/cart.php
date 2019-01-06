<?php
	require_once('core/init.php');
	include_once('includes/header.php');
	include_once('helpers/helpers.php');
?>

	<!-- Title Page -->
	<section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url(images/icons/cart.jpg);">
		<h2 class="l-text2 t-center">
			Carucior de cumparaturi
		</h2>
	</section>

	<!-- Cart -->
	<section class="cart bgwhite p-t-70 p-b-100">
		<div class="container">
			<!-- Cart item -->
			<div class="container-table-cart pos-relative">
				<div class="wrap-table-shopping-cart bgwhite">

<?php
if($cart_id != ''):?>
	<?php
		$cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
		$result = mysqli_fetch_assoc($cartQ);
		$items = json_decode($result['items'], true); 
		$i = 0;
		$total = 0;
		$available = 0;
		foreach($items as $cout_item) {
			$i++;
		}
?>
					<table class="table-shopping-cart">
						<tr class="table-head">
							<th class="column-1"></th>
							<th class="column-2">Product</th>
							<th class="column-3">Price</th>
							<th class="column-4 p-l-70">Quantity</th>
							<th class="column-5">Total</th>
						</tr>
<?php foreach($items as $item):?>
	<?php
		$product_id = $item['id'];
		$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
		$product_cart = mysqli_fetch_assoc($productQ);
		$sArray = json_decode($product_cart['sizes']);
		foreach($sArray as $size => $qan ){
								
			if($item['size'] == $size) {	
					$available = $qan;
					break;
				}
			}
	?>	
						<tr class="table-row">
							<td class="column-1">
								<div class="cart-img-product b-rad-4 o-f-hidden">
									<img src="images/products/<?= $product_cart['cover_img']; ?>" alt="IMG-PRODUCT">
								</div>
							</td>
							<td class="column-2"><?= $product_cart['title']; ?></td>
							<td class="column-3"><?= $product_cart['price']; ?> LEI</td>
							<td class="column-4">
								<div class="flex-w bo5 of-hidden w-size17">
									<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2" onclick="update_cart('removeone','<?=$product_cart['id'];?>','<?=$item['size'];?>' );">
										<i class="fs-12 fa fa-minus" aria-hidden="true"></i>
									</button>

									<input class="size8 m-text18 t-center num-product" type="number" name="num-product1" value="<?= $item['quantity']; ?>">
									<?php if($item['quantity'] < $available): ?>
										<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" onclick="update_cart('addone','<?=$product_cart['id'];?>','<?=$item['size'];?>' );">
											<i class="fs-12 fa fa-plus" aria-hidden="true"></i>
										</button>
									<?php else: ?>
                                    	<span class="text-danger"> Valoare maxima</span>
                                	<?php endif; ?>
								</div>
							</td>
							<td class="column-5"><?= ($item['quantity'] * $product_cart['price'])?> LEI</td>
							<?php $total += $item['quantity'] * $product_cart['price']?> LEI
						</tr>
<?php endforeach;?>	
					</table>
<?php else:?>
					<H4>Cosul de cumparaturi este gol</H4>

<?php endif;?>
				</div>
			</div>

			<div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
				<div class="flex-w flex-m w-full-sm">
					<div class="size11 bo4 m-r-10">
						<input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="coupon-code" placeholder="Coupon Code">
					</div>

					<div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
						<!-- Button -->
						<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
							Apply coupon
						</button>
					</div>
				</div>

			
					Taxa de transport este 20 LEI la comenzi sub 60 LEI.
					</br>
					La comenzi peste 60 taxa de transport este 0 LEI.
			
			</div>

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h5 class="m-text20 p-b-24">
					Cart Totals
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-b-12" >
					<span class="s-text18 w-size19 w-full-sm" style="margin: auto;">
						Subtotal:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
						<?=$total ;?> 
					</span>
				</div>

				<!--  -->
				<div class="flex-w flex-sb bo10 p-t-15 p-b-20 m-r-0 m-l-auto" >
					<span class="s-text18 w-size19 w-full-sm">
						Date Comanda
					</span>
				</div>
				<div class="w-size20 w-full-sm">
					<span class="s-text18 w-size19 w-full-sm">
						Modalitate de plata
					</span>
					<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="paid" id="paid">
								<option value="1">Card</option>
								<option value="2">Ramburs</option>
							</select>
					
					</div>
					<div class="w-size20 w-full-sm">
						<p class="s-text8 p-b-23">
							Va rugam introduceti adresa de livrare.
						</p>

						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="nume" placeholder="Numele">
						</div>

						<div class="size13 bo4 m-b-12">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="email" placeholder="Email">
						</div>
							
						<div class="size13 bo4 m-b-12">
						<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="judet" placeholder="Judet / Sector">
						</div>

						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="city" placeholder="Oras">
						</div>
						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="street" placeholder="Strada">
						</div>
						<div class="size13 bo4 m-b-22">
							<input class="sizefull s-text7 p-l-15 p-r-15" type="number" name="number" placeholder="Numar">
						</div>
						<div id="payment">
							<div class="size13 bo4 m-b-22">
								<input class="sizefull s-text7 p-l-15 p-r-15" type="text" name="number_card" placeholder="Numar Card:">
							</div>
							<div class="size13 bo4 m-b-22">
								<input class="sizefull s-text7 p-l-15 p-r-15" type="number" name="cvc" placeholder="CVC:">
							</div>
							<div class="rs2-select2 rs3-select2 rs4-select2 bo4 of-hidden w-size21 m-t-8 m-b-12">
							<select class="selection-2" name="paid">
								<option>Anul de expirare:</option>
								<?php $yr = date("Y");?>
                                        <?php for($i=0; $i<11; $i++):?>
                                            <option value="<?=$yr + $i;?>"><?=$yr + $i;?></option>
                                        <?php endfor; ?>
							</select>
					
					</div>
						</div>
					</div>
				</div>

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						Total:
					</span>

					<span class="m-text21 w-size20 w-full-sm">
					<?php if($total > 60) {
							echo $total;
						}else {
							echo $total + 20;
						}
						?> LEI
					</span>
				</div>

				<div class="size15 trans-0-4">
					<!-- Button -->
					<button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4" >
						Finlizare
					</button>
				</div>
			</div>
		</div>
	</section>

	<?php include ('includes/footer.php'); ?>
