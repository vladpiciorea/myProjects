<?php

class TokenModel {
	
	public static function generateToken() {
		
		$token = rand(10000000, 20000000);

		$db = GeneralModel::init_db();
		
		$db->query("INSERT INTO form_tokens (token, creation) VALUES (".$token.", ".time().")");
		
		return $token;
		
	}
	
}

?>