<?php
require_once('../core/init.php');
include_once('../helpers/helpers.php');

if($cart_id != '') {
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'], true); 
    $i = 1;
    $sub_total = 0;
    $item_count = 0;
    
echo '<div class="change_cart" class="header-wrapicon2">
<img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
<span class="header-icons-noti">'.$i.'</span>
<!-- Header cart noti -->
<div class="header-cart header-dropdown">
    <ul class="header-cart-wrapitem">
        <li class="header-cart-item">
            <div class="header-cart-item-img">';

	foreach($items as $item) {
		$product_id = $item['id'];
		$productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
		$product = mysqli_fetch_assoc($productQ);
		$sArray = json_decode($product['sizes']);

echo '<img src="images/product/" alt="IMG">
        </div>

        <div class="header-cart-item-txt">
            <a href="/images/products/'.$product['cover_img'].'" class="header-cart-item-name">
                '.$product['title'].'
            </a>

            <span class="header-cart-item-info">
                '.$item['quantity'].'x '.$product['price'].'
                </span>
            </div>
        </li>  
    </ul>';
		
    }
echo '<div class="header-cart-total">
    Total: 
</div>

<div class="header-cart-buttons">
    <div class="header-cart-wrapbtn">
        <!-- Button -->
        <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
            View Cart
        </a>
    </div>

    <div class="header-cart-wrapbtn">
        <!-- Button -->
        <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
            Check Out
        </a>
    </div>
</div>
</div>
</div>';
}