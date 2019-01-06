<?php

class ProductsView {
	
	public static function generateOutput($products) {
		
		$output = '';
		
		foreach ($products as $product)	{
			
			$output .= '<ul>';

				$output .= '<a href="'.$product['html'].'">';
				$output .= '<img src="'.$product['img'].'" alt="Nume poza">';
				$output .= '<li>Nume: <b>'.$product['name'].' </b> Pret '.$product['price'].'</li>';
				$output .= '</a>';
			
			$output .= '</ul>';
			
		}
		
		echo $output;
		
	}
	
}
?>
<a href="http://"></a>
