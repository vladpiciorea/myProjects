<?php

class GeneralModel {
	
	private static $dbconn;
	
	private function __construct() {}
	
	public static function init_db() {
		
		if (is_null(self::$dbconn)) {
		
			$dsn = 'mysql:dbname=produse;host=localhost;port=3306';
			$username = 'root';
			$password = '';
			
			$options = array (
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			);
			
			self::$dbconn = new PDO($dsn, $username, $password, $options);
		
		}
		
		return self::$dbconn;
		
	}
	
	
	public static function getData($search, $type = 'url') {
		
		$data = array();
		
		if ($type == 'url') {
			
			$data = self::getURLData($search);
			
		} else if ($type == 'db') {
			
			$data = self::getDBData($search);
			
		}
		
		return $data;
		
	}
	
	private static function getURLData($search) {
	
	// initializare curl
	$curl = curl_init();
	
	$url = 'https://lajumate.ro/'.$search;

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$result = curl_exec($curl);

	preg_match_all('!https://lajumate.ro/[^\s]*?.html!', $result, $matches);
	preg_match_all('!<i>Preţ</i>[^\s]*? [^\s]*?</span>!', $result, $price);
	

	$i = 0;
	$data = array();
	
	foreach($matches[0] as $match){

		// Elimin linkurile nefolositore
		$check_1 = strpos($match,'anunturi');
		$check_2 = strpos($match,'tag');
		$check_3 = strpos($match,'promovare');
		$check_4 = strpos($match,'aplicatie');
		$check_5 = strpos($match,'validare');
		$check_6 = strpos($match,'spoturi');
		$check_7 = strpos($match,'cauta');
	
		
		if($check_1 != 20 && $check_2 != 20 && $check_3 != 20 && $check_4 != 20 && $check_5 != 20 && $check_6 != 20 && $check_7 !=20) {
		
			// Compunere url img
			$match = substr($match, 20);
			$match = explode('.', $match);
			
			$code = substr($match[0], -7);
			$first_code = substr($code, 0, 3);
			$name = substr($match[0],0, -8);
			$img_url = 'https://media2.lajumate.ro/media/i/cart/1/'. $first_code . '/' . $code. '_'. $name . '_1.jpg';

			// Compunere nume produs
			$name_pod = str_replace('-', ' ', $name);

			// Compunere url produs
			$match_html = 'https://lajumate.ro/' . $match[0] . '.html';

			// Compunere pret produs
			
			$price_prod = $price[0][$i];
			$price_prod = substr($price_prod, 4);
			$price_prod = substr($price_prod, 4);
			$i++;
			$data[] = ['img' =>$img_url,
						'name' => $name_pod,
						'html' => $match_html,
						'price' => $price_prod
					];
			
		}
	}
	
	curl_close($curl);
		
return $data;
		
	}
	
	private static function getDBData($search) {
		
		$data = array();
		
		try {
		
			$db = self::init_db();
		
			$query = "SELECT * FROM produse WHERE marca LIKE :search";
		
			$results = $db->prepare($query);
			
			$results->execute(
				array(':search' => '%'.$search.'%')
			);
			
			while ($row = $results->fetch()) {
				
				$data[] = $row;
				
			}
		
		} catch (PDOException $e) {
			
			//echo $e->getMessage();
			
		}
		
		return $data;
		
	}
	
}