<?php

class ApiView {
	
	public static function generateOutput($products) {
		
		header('Content-Type: application/json');
		
		echo json_encode($products);
		
	}
	
}