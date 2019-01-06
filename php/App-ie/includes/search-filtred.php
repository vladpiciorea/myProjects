<?php
require_once '../core/init.php';
include '../helpers/helpers.php';

$search = ((isset($_POST['search']))? sanitize($_POST['search']) : 0);
$cat_id = ((isset($_POST['cat_id']))? (int)$_POST['cat_id'] : 0);
$product = '';

if($cat_id != 0) {
                // Face a uniune a tabelului cu el insusi
                $query = "SELECT p.id As 'pid', p.category AS 'category', c.id AS 'cid', c.category AS 'child' FROM categories c 
                INNER JOIN categories p ON c.parent = p.id WHERE p.id = '$cat_id'";
    
                $products_id = $db->query($query);
                $count = mysqli_num_rows($products_id);
    
                // Verifica daca este parine
                if($count != 0){
                    $product .= " (";
                    while($result = mysqli_fetch_assoc($products_id)) {
    
                        $product .= " categories = '".$result['cid']."' OR";
                        $filter_cat = ' current';
                    }
                    $product .= " categories = '".$cat_id."')";
                // echo $product;
                    }else {
                        // Daca nu este parinte atribuie valore get-ului
                        $product .= " categories = '$cat_id'";
                    }
            }

$sql = "SELECT * FROM products WHERE  deleted != 1 AND $product AND title LIKE '%$search%' OR title LIKE '$search%' OR title LIKE '%$search'";

// echo $sql;
$products = $db->query($sql);
?>
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
						<div class="block2-btn-addcart w-size1 trans-0-4">
								<!-- Button -->
							<button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
									Add to Cart
							</button>
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
