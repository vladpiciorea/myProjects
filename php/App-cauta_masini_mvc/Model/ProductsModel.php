<?php

class ProductsModel {
	
	public static function getAllProducts($search = '') {
		
		$data = GeneralModel::getData($search);
		
		return $data;
		
	}
	
	public static function getFilteredProducts($input) {
		
		$filtered_data = array();
		//Compunere prima parte a linkului
		$search_first = '';

		if(isset($input['search']) && !empty($input['search'])){

			$search_first .= 'cauta_'.$input['search'].'_autoturisme';
		}else{
			$search_first .= 'anunturi_autoturisme';
		}

		if(isset($input['pret_max']) && $input['pret_max'] != '' ) {

			$search_first .= '_pret-pana-la-'.$input['pret_max'];
			
		}

		// Compunere a doua parte a linkului
		$search_second = '?';
		if(isset($input['culoare'])) {
			$search_second .= ($input['culoare'] == 'alb')? 'co=1':'';
			$search_second .= ($input['culoare'] == 'rosu')? 'co=9': '';
			$search_second .= ($input['culoare'] == 'albastru')? 'co=2': '';
			$search_second .= ($input['culoare'] == 'negru')? 'co=8': '';
			$search_second .= '&';
		}

		if(isset($input['an_fabricatie'])) {
			$search_second .= ($input['an_fabricatie'] == '2015')? 'yf=2015': '';
			$search_second .= ($input['an_fabricatie'] == '2016')? 'yf=2016': '';
			$search_second .= ($input['an_fabricatie'] == '2017')? 'yf=2017': '';
			$search_second .= ($input['an_fabricatie'] == '2018')? 'yf=2018': '';
			$search_second .= '&';
		}
		
		
		$search_second = rtrim($search_second, '&');
		$search_second = rtrim($search_second, '?');

		// Compunere link
		$search = $search_first.'.html'.$search_second;
		
		$data = self::getAllProducts($search);
		
		// foreach ($data as $product) {
			
		// 	$is_result = true;
			
		// 	/*if (!empty($input['search']) && stripos($product['marca'], $input['search']) === false) {
				
		// 		$is_result = false;
				
		// 	}*/
			
		// 	if ($is_result && $input['culoare'] != 'all' && $product['culoare'] != $input['culoare']) {
				
		// 		$is_result = false;
				
		// 	}
			
		// 	if ($is_result && $input['an_fabricatie'] != 'all' && $product['an_fabricatie'] != $input['an_fabricatie']) {
				
		// 		$is_result = false;
				
		// 	}
			
		// 	if (!empty($input['pret_max']) && $is_result && $product['pret'] > $input['pret_max']) {
				
		// 		$is_result = false;
				
		// 	}
			
		// 	if ($is_result) {
			
		// 		$filtered_data[] = $product;
			
		// 	}
			
		// }
		
		return $data;
		
	}
	
}