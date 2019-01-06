<?php
    class Utils {

        public static function class_folders() {

            if(!empty($_SERVER['class_folders'])) {
                return false;
            }
            $cwd = getcwd();
            $folders = scandir($cwd);
        
            foreach($folders as $folder) {
                if(is_dir($cwd.'/'.$folder) || $folder == '.' || $folder = '..') {
                    unset($folders[$folder]);
                }
            }
        // salvare foldere pt a nu rula functia de mai multe ori
            $_SERVER['class_folders'] = $folders;
        
        }
           
           public static function auto_register() {

                spl_autoload_register(
                
                        function($class_name) {
                            // Codul de auto load
                            $folders = $_SERVER['class_folders']; 

                            foreach($folders as $folder) {
                                $file_path = $folder.'/'.$class_name.'.php';
                                if(file_exists($file_path)) {
                                    require_once $file_path;
                                    break;
                                }
                            }
                            
                        }
                    );
            }

            public static function check_token($input) {

                if (isset($input['token']) && is_numeric($input['token'])) {

//                    Verific in db si il sterg, TODO: verific tokenul mai vechi de o

                    return true;

                }

                return false;
            }
    }