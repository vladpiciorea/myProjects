<?php

class creareMasini {
	
	public $culoare;
	public $marca;
	public $motor;
	public $combustibil;
	protected $echipare;
	
	public function __construct($culoare, $marca, $motor, $combustibil, $separator) {
		
		$this->culoare = $culoare;
		$this->marca = $marca;
		$this->motor = $motor;
		$this->combustibil = $combustibil;
		$this->generareEchipare($separator);
		
	}
	
	protected function generareEchipare($separator = ', ') {
		
		$this->echipare = $this->marca.$separator.$this->motor.$separator.$this->combustibil.$separator.$this->culoare;
		
	}
	
	final function echipare() {
		
		return $this->echipare;
		
	}
	
}

$masina1 = new creareMasini('alb', 'BMW X3', '150cp', 'benzina', '|');

//var_dump($masina1);

//echo $masina1->echipare();

/*$masina1->culoare = 'alb';
$masina1->marca = 'BMW X3';
$masina1->motor = '150cp';
$masina1->combustibil = 'benzina';
*/

class creareMotocicleta extends creareMasini {
	
	/*public function echipare() {
		
		return 'test';
		
	}*/
	
}

$motocicleta1 = new creareMotocicleta('alb', 'Suzuki', '150cp', 'benzina', '|');

echo $motocicleta1->echipare();

var_dump($motocicleta1);
