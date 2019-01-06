<?php

    class ProductsView {
        
        public static function generateOutput($products) {

            $output = '';
            foreach($products as $product) {
                $output .= '<ul>';
                    foreach ($product as $key => $value) {
                        $output .= '<li><b>'.$key.': '.$value.'</li>';
                    }
                $output .= '</ul>';
            }
            echo $output;
        }
    }