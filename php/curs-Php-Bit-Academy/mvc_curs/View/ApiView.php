<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 29.06.2018
 * Time: 21:10
 */
class ApiView {

    public static function generateOutput($products) {
        header('Content-Type: application/json');
        echo json_encode($products);
    }
}
