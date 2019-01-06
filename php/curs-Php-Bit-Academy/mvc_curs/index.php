<?php
//    function class_folders() {

//     $cwd = getcwd();
//     $folders = scandir($cwd);

//     foreach($folders as $folder) {
//         if(is_dir($cwd.'/'.$folder) || $folder == '.' || $folder = '..') {
//             unset($folders[$folder]);
//         }
//     }
// // salvare foldere pt a nu rula functia de mai multe ori
//     $_SERVER['class_folders'] = $folders;

//    }
//    if(empty($_SERVER['class_folders'])) {
//         class_folders();
//    }
//    spl_autoload_register(

//         function($class_name) {
//             // Codul de auto load
//             $folders = $_SERVER['class_folders'];  
//             foreach($folders as $folder) {
//                 if(strpos($class_name,$folder) !== false) {
//                     require_once $folder.'/'.$class_name.'.php';
//                     break;
//                 }
//             }
            
//         }
//     );
require_once 'helpers/Utils.php';
Utils::class_folders();
Utils::auto_register();

$controller = new ProductsController;
$controller->process_page();