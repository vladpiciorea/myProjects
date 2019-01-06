<?php

class ProductsController {
	
	private $input;
	private $api;
	private $filtered_input;
	private $products;
	
	public function __construct() {
		
		$this->input = empty($_REQUEST) ? false : $_REQUEST;
		$this->api = isset($_REQUEST['api']) ? true : false;
		
	}
	
	public function process_page() {
		
		if (!$this->api) {
		
			if ($this->input !== false) {
				
				$check_token = Utils::check_token($this->input);
				
				if (!$check_token) { die(); }
				
				$this->process_request();
				
				$this->products = ProductsModel::getFilteredProducts($this->filtered_input);
				
			} else {
				
				$this->products = ProductsModel::getAllProducts();
				
				
			}
			
			$token = TokenModel::generateToken();
			
			FilterView::generateOutput($this->filtered_input, $token);
			
			ProductsView::generateOutput($this->products);
		
		} else {
			
			$this->process_request();
			
			$this->products = ProductsModel::getAllProducts();
			
			// TODO: sa folosim si filtered products atunci cand este cazul
			
			ApiView::generateOutput($this->products);
			
		}
		
	}
	
	private function process_request() {
	
		$string_keys = array('search', 'culoare');
		$numeric_keys = array('pret_max');
		
		foreach ($this->input as $key => $value) {
			
			if (in_array($key, $string_keys)) {
				
				$value = trim(htmlentities($value));
			
			} else if (in_array($key, $numeric_keys)) {
			
				$value = str_replace(
					array(' ',','),
					array('', '.'),
					$value
				);
				
				$value = (float)$value;
			}

			$this->filtered_input[$key] = $value;
			
		}
		
	}
	
}