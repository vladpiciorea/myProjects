<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 29.06.2018
 * Time: 19:32
 */

class TokenModel {

    public static function generateToken() {

        $token = rand(1000000, 2000000);
        $db = GeneralModel::init_db();
        $db->query("INSERT INTO form_tokens(token, creation) VALUES (".$token.", ".time().")");
        return $token;
    }
}