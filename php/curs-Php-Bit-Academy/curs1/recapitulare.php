<?php

$a = 'test';
$a = 5;
$a = true;
$a = null;
//$a = array('a', 'b', 'c' => array(1, 2, 3, 4, 5));

$b = $a;
$c = &$a;

$d = "test ".$a;
$d = (int)'123a';
/*
$_GET
$_POST
$_REQUEST
$_SERVER
$_COOKIE
$_SESSION
*/
define('a', 'test');

echo a;

if (!($a > 0)) {
	
	echo 'test';
	
} else if ($a < 0) { } else { }

for ($i = 0; $i < 10; $i++) {
	
	echo $i;
	
}

$i = 0;

while ($i < 10) {
	
	echo $i;
	$i++;
	
}

$a = array(1, 2, 3, 4);

foreach ($a as $k => $v) {
	
	echo $v;
	
}

$a = 4;

function test(&$x, $y) {
	
	$suma = $x + $y;
	
	return $suma;
	
}

echo test($a, $b);
echo $a;
/*
include('functions.php');
require('functions.php');

include_once('functions.php');
require_once('functions.php');
*/
?>

<form action="" method="post">

	<input type="text" name="nume" />
	
	<select name="departament">
		<option value="1">IT</option>
	</select>
	
	<input type="submit" value="Trimitere" />

</form>









