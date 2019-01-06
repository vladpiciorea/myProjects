<?php

class FilterView {
	
	public static function generateOutput($input, $token) {
		
		$search_val = isset($input['search']) ? $input['search'] : '';
		
		// TODO: sa preluam si sa pre-setam si valorile pentru restul campurilor
		
		$separator = ' | ';
		$output = '';
		
		$output .= '<form autocomplete="off">';
		
			$output .= '<input type="text" name="search" placeholder="Search" value="'.$search_val.'" />';
			
			$output .= $separator;
			
			$output .= '<select name="culoare">';
				$output .= '<option value="all" selected>Selecteaza o culoare</option>';
				$output .= '<option value="alb">Alb</option>';
				$output .= '<option value="rosu">Rosu</option>';
				$output .= '<option value="albastru">Albastru</option>';
				$output .= '<option value="negru">Negru</option>';
			$output .= '</select>';
			
			$output .= $separator;
		
			$output .= '<select name="an_fabricatie">';
				$output .= '<option value="all" selected>Selecteaza un an de fabricatie</option>';
				$output .= '<option value="2015">2015</option>';
				$output .= '<option value="2016">2016</option>';
				$output .= '<option value="2017">2017</option>';
				$output .= '<option value="2018">2018</option>';
			$output .= '</select>';
			
			$output .= $separator;
			
			$output .= '<input type="text" name="pret_max" placeholder="Pret maxim" />';
			
			$output .= $separator;
			
			$output .= '<input type="hidden" name="token" value="'.$token.'" />';
			
			$output .= '<input type="submit" value="Filtrare" />';
			
			$output .= $separator;
			
			$output .= '<a href="/">Resetare</a>';
		
		$output .= '</form>';
		
		$output .= '<hr />';

		echo $output;
		
	}
	
}