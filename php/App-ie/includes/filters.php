<?php
//De la parinte la copil
$query_p = "SELECT * FROM categories WHERE id = '$cat_id' AND parent = 0";
$sql_p = $db->query($query_p);
$count_p = mysqli_num_rows($sql_p);
$query_c = "SELECT * FROM categories WHERE parent = '";
//De la copil al parinte
$query_cv = "SELECT * FROM categories WHERE id = '$cat_id' AND parent != 0";

$query_p1 = "SELECT * FROM categories WHERE id = '";
?>
<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Categorii
						</h4>

						<ul class="p-b-54">
							
							<?php if($count_p > 0): ?>
								<?php while($parent = mysqli_fetch_assoc($sql_p)):?>
									<?php if ($parent['parent'] == 0):?>
									<li class="p-t-4">
										<a href="product.php?cat=<?= $parent['id'];?>" class="s-text13 active1 current">
											<?= $parent['category'];?>
										</a>
									</li>	
										<?php
										$query_c .= $parent['id']."'";
										$sql_c = $db->query($query_c);
										$count = mysqli_num_rows($sql_c);
										?>
										<?php if($count != 0):

												while($child = mysqli_fetch_assoc($sql_c)):?>
										<li class="p-t-4">
											<a href="product.php?cat=<?= $child['id'];?>" class="s-text13 active1 child <?=(($child['id'] == $cat_id)? ' current' : ''); ?>">
												<?= $child['category'];?>
										</a>
										</li>
												<?php endwhile; ?>
										<?php endif; ?>
										<?php endif;?>
									<?php endwhile; ?>
								<?php else: ?>
										<?php 
										
											$sql_c = $db->query($query_cv);
											$child = mysqli_fetch_array($sql_c);
											$query_p1 .= $child['parent']."'";
											$sql_p = $db->query($query_p1);
											$parent = mysqli_fetch_array($sql_p);
											?>
												<li class="p-t-4">
													<a href="product.php?cat=<?= $parent['id'];?>" class="s-text13 active1 ">
														<?= $parent['category'];?>
													</a>
												</li>
											<?php
											$query_c .= $parent['id']."'";
											$sql_c = $db->query($query_c);
											?>
											<?php while($child = mysqli_fetch_assoc($sql_c)):?>
												<li class="p-t-4">
													<a href="product.php?cat=<?= $child['id'];?>" class="s-text13 active1 child <?=(($child['id'] == $cat_id)? ' current ' : ''); ?>">
														<?= $child['category'];?>
												</a>
												</li>
											<?php endwhile; ?>
							<?php endif;?>
							
						</ul>

						<!--  -->
						<h4 class="m-text14 p-b-32">
							Filters
						</h4>

						<div class="filter-price p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-17">
								Pret
							</div>

							<div class="wra-filter-bar">
							<input type="text" name="min_price" id="min_price" class="price-range" placeholder = "Min LEI" value="<?=((isset($min_price))? $min_price : '');?>">LEI
									</br>
									 Pana
									</br>
    								<input type="text" name="max_price" id="max_price" class="price-range" placeholder = "Max LEI" value="<?=((isset($max_price))? $max_price : '');?>">LEI
							</div>
						</div>

						<div class="filter-color p-t-22 p-b-50 bo3">
							<div class="m-text15 p-b-12">
								Color
							</div>

							<ul class="flex-w">
								<!-- <li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1" >
									<label class="color-filter color-filter1" for="color-filter1"></label>
								</li> -->

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter-blue" type="checkbox" name="color-filter-blue" >
									<label class="color-filter color-filter-blue" for="color-filter-blue"></label>
								</li>

								<!-- <li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
									<label class="color-filter color-filter3" for="color-filter3"></label>
								</li> -->

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter-red" type="checkbox" id="red" name="color-filter-red">
									<label class="color-filter color-filter-red" for="color-filter-red"></label>
								</li>

								<!-- <li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
									<label class="color-filter color-filter5" for="color-filter5"></label>
								</li> -->

								<li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter-black" type="checkbox" id="black" name="color-filter-black">
									<label class="color-filter color-filter-black" for="color-filter-black"></label>
								</li>

								<!-- <li class="m-r-10">
									<input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
									<label class="color-filter color-filter7" for="color-filter7"></label>
								</li> -->
								
							</ul>
							<div class="w-size11">
										</br>
									<!-- Button -->
									<button class="flex-c-m size4 bg7 bo-rad-15 hov1 s-text14 trans-0-4" onclick="filtre(<?=$cat_id?>)">
										Filtreaza
									</button>
								</div>
						</div>

						<div class="search-product pos-relative bo4 of-hidden">
							<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" id="search-product" placeholder="Search Products...">

							<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4" onclick="search_product(<?=$cat_id?>)">
								<i class="fs-12 fa fa-search" aria-hidden="true"></i>
							</button>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!--  -->
					<div class="flex-sb-m flex-w p-b-35">
						<div class="flex-w">
							<div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
								<select id="my_selection" class="selection-2" name="sorting">
									<option > Sorteaza </option>
									<option value="1">Popularity</option>
									<option value="2">Price: low to high</option>
									<option value="3">Price: high to low</option>
								</select>
							</div>				
						</div>

			
					</div>
