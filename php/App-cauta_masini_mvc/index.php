<?php

require_once('Helper/Utils.php');

Utils::class_folders();
Utils::class_autoloader();

$controller = new ProductsController;
$controller->process_page();
