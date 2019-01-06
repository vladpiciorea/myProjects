<?php

    class ProductsModel {

        public static function getALLProducts() {
// ia data din general modal
            $data = GeneralModel::get_data();

            return $data;
        }

        public static function getFilteredProducts($input) {

            $filtred_data = array();
            $data = self::getALLProducts();
            foreach ($data as  $product) {
                
                $is_result = true;

                if(!empty($input['search']) && stripos($product['marca'], $input['search']) === false) {
                    $is_result = false;
                }

                if($is_result && !empty($input['culoare']) !='all' && $product['culoare'] != $input['culoare']) {
                    $is_result = false;
                }

                if($is_result && !empty($input['an_fabricatie']) !='all' && $product['an_fabricatie'] != $input['an_fabricatie']) {

                    $is_result = false;
                }

                if($is_result && !empty($input['pret_max']) && $product['pret'] > $input['pret_max']) {
                    
                    $is_result = false;
                }

                if($is_result) {
                    $filtred_data[] = $product;
                }

            }
           
            return $filtred_data;
            // filtered products
            return $data;
        }
        
    }