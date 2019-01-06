<?php

class Utils {
	
	public static function class_folders() {
		
		if (!empty($_SERVER['app_folders'])) { return false; }
		
		$cwd = getcwd();
		
		$folders = scandir($cwd);
		
		foreach ($folders as $k => $folder) {
			
			if (!is_dir($cwd.'/'.$folder) || $folder == '.' || $folder == '..') {
				
				unset($folders[$k]);
				
			}
			
		}
		
		$_SERVER['app_folders'] = $folders;
		
	}
	
	public static function class_autoloader() {
		
		spl_autoload_register(

			function($class_name) {
				
				$folders = $_SERVER['app_folders'];
				
				foreach ($folders as $folder) {
					
					$file_path = $folder.'/'.$class_name.'.php';
					
					if (file_exists($file_path)) {
					
						require_once($file_path);
						
						break;
					
					}
					
				}

			}

		);
		
	}
	
	public static function check_token($input) {
		
		if (isset($input['token']) && is_numeric($input['token'])) {
			
			// TODO: verific token in db, il compar cu cel din formular si la final il sterg
			
			// TODO: verific token-urile mai vechi de o saptamana si le sterg
			
			return true;
			
		}
		
		return false;
		
	}
	
}