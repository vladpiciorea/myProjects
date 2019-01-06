<?php

    class GeneralModel {
        private static $dbcon;
        private function __construct(){}
        public static function init_db() {

            if(is_null(self::$dbcon)){
                $dsn = 'mysql:dbname=produse;host=localhost;port=3306';
                $username = 'root';
                $password = '';
    
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                );
    
                self::$dbcon = new PDO($dsn, $username, $password, $options);
            }
            return self::$dbcon;
        }
        public static function get_data($type = 'db') {

            $data = array();

            if($type == 'csv') {

                $data = self::getCSVData();
                
            }else {

                $data = self::getDBData();
            }
            return $data;
        }

        private static function getCSVData() {

            $data = array();

            $fille_str = file_get_contents('produse.csv');

            $rows_arr = explode(PHP_EOL, trim($fille_str));

            $cols_arr = explode('|',$rows_arr[0]);
            unset($rows_arr[0]);

            foreach($rows_arr as $row) {

                $rows_arr = explode('|',$row);
                $final_arr = array_combine($cols_arr, $rows_arr);

                $data[] = $final_arr;


            }
            return $data;

        }

        private static function getDBData() {

            $data = array();
            try{

                $db = self::init_db();
                $query = "SELECT * FROM produse";
                $result = $db->query($query);
                
                
                
                    while($row = $result->fetch()){

                        $data[] = $row;
                    }

            }catch(PDOException $e) {

                // gestionare eroare
                echo $e->getCode();
            }
           
            return $data;

        }
    }