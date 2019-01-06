<?php

    class FilterView {
        
        // public function __construct(){

        // }

        public static function generateOutput($input, $token) {

            $search_val = isset($input['search']) ? $input['search']: '';
            $separator = ' |';
            $output = '';
            $output = '<form autocomplete="off">';
                $output .= '<input type="text" name="search" value='.$search_val.' placeholder = "Search"/>' . $separator;
                $output .= '<select name="culoare" >';
                    $output .= '<option value="all" selected >Selecteaza o culoare</option>';
                    $output .= '<option value="alb" >Alb</options>';
                    $output .= '<option value="rosu" >Rosu</options>';
                    $output .= '<option value="albastru" >Albastru</option>';
                    $output .= '<option value="negru" >Ngru</option>';
                $output .= '</select>' . $separator;
                $output .= '<select name="an_fabricatie" >';
                    $output .= '<option value="all" selected >Selecteaza un an de fabriatie</option>';
                    $output .= '<option value="2015" >2015</option>';
                    $output .= '<option value="2016" >2016</option>';
                    $output .= '<option value="2017" >2017</option>';
                    $output .= '<option value="2018" >2018</option>';
                $output .= '</select>' . $separator;
                $output .= '<input type="text" name="pret_max" placeholder = "Pret max"/>' . $separator;
            $output .= '<input type="hidden" name="token" value="'.$token.'"/>' . $separator;
                $output .= '<input type="submit" value="Filtrare"/>' . $separator;
                $output .= '<a href="#">Reset</a>' . $separator;
            $output .= '</form>';
            $output .= '<hr/>';


            echo $output;
        }
    }