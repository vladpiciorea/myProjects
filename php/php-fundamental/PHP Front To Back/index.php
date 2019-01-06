<?php
	#****VARIABLES****
		// - Prefix $
		// - Start with a letter or an underscore
		// - Only letters, numbers and underscores
		// - Case sensitive	
	#DATA TYPES
		// String, Integers, floats, Booleans, Arrays, Objects, NULL, Resource
		
	$output = 'Hello World!';

	$num1 = 4;
	$num2 = 10;
	$sum = $num1 + $num2;

	$string1 = 'Hello';
	$string2 = 'World';
	$greeting = $string1 .' '. $string2.'!';
	$greeting2 = "$string1 $string2";

	$string3 = "They\"re Here";

	$float1 = 4.4;
	$bool1 = true;
	// Constanta 
	define('GREETING', 'Hello Everyone', true);

    echo greeting;

    #******Array****
	/*
		- Indexed
		- Associative
		- Multi-dimensional
	*/
?>
<hr/>
<?php
	// Indexed
	$people = array('Kevin', 'Jeremy', 'Sara');
	$ids = array(23, 55, 12);
	$cars = ['Honda', 'Toyota', 'Ford'];
	$cars[3] = 'Chevy';
	$cars[] = 'BMW';

	//echo count($cars);
	//print_r($cars);
	//var_dump($cars);

	//echo $people[3];
	//echo $ids[2];
	//echo $cars[4];

	// Associative arrays
	$people = array('Brad' => 35, 'Jose' => 32, 'William' => 37);
	$ids = [22 => 'Brad', 44 => 'Jose', 63 => 'William'];

	//echo $people['Brad'];
	//echo $ids[22];
	$people['Jill'] = 42;
	//echo $people['Jill'];
	//print_r($people);
	//var_dump($people);

	//Multi-Dimensional
	$cars = array(
		array('Honda', 20, 10),
		array('Toyota', 30, 20),
		array('Ford', 23, 12)
	);

	echo $cars[1][2];

?>
<hr/>
<?php
	# LOOPS - Execute code set number of times

	/*
		For
		While
		Do..While
		Foreach
	*/

	# For Loop
	# @params - init, condition, inc

	/*
	for($i = 5;$i <= 10;$i++){
		echo 'Number '.$i;
		echo '<br>';
	}
	*/

	# While Loop
	# @params - condition

	/*
	$i = 0;

	while($i < 10){
		echo $i;
		echo '<br>';
		$i++;
	}
	*/

	# Do...While
	# @params - condition
	/*
	$i = 0;

	do{
		echo $i;
		echo '<br>';
		$i++;
	}

	while($i < 10);
	*/

	# Foreach Loop - For arrays
	/*
	$people = array('Brad', 'Jose', 'William');

	foreach($people as $person){
		echo $person;
		echo '<br>';
	}
	*/

	$people = array('Brad' => 'brad@gmail.com', 'Jose' => 'jose@gmail.com', 'William' => 'will@gmail.com');

	foreach($people as $person => $email){
		echo $person.': '.$email;
		echo '<br>';
	}
?>
<hr/>
<?php
	# FUNCTION - Block of code that can be repeatedly called

	/*
		Camel Case - myFunction()
		Lower Case - my_function()
		Pascal Case - MyFunction()
	*/

	// Create Simple Function
	function simpleFunction(){
		echo 'Hello World';
	}

	// Run Simple Function
	//simpleFunction();

	// Function With Param
	function sayHello($name = 'World'){
		echo "Hello $name<br>";
	}

	//sayHello('Joe');
	//sayHello('Bob');
	//sayHello('Tim');

	// Return Value
	function addNumbers($num1, $num2){
		return $num1 + $num2;
	}

	//echo addNumbers(2,3);

	// By Reference

	$myNum = 10;

	function addFive($num){
		$num += 5;
	}

	function addTen(&$num){
		$num += 10;
	}

	addFive($myNum);

	echo "Value: $myNum<br>";

	addTen($myNum);

	echo "Value: $myNum<br>";
?>
<hr/>
<?php
	# CONDITIONALS

	/*
		==
		===
		<
		>
		<=
		>=
		!=
		!==
	*/

	/*
		$num = 4;

		if($num == 5){
			echo '5 passed';
		} elseif($num == 6){
			echo '6 passed';
		} else {
			echo 'did not pass';
		}
	*/

	# NESTING IF

	$num = 6;

	/*
		if($num > 4){
			if($num < 10){
				echo "$num passed";
			} else {
				echo 'whatever';
			}
		}
	*/

	/*
		LOGICAL OPERATORS

		and  &&
		or   ||
		xor
	*/

	/*
		if($num > 4 XOR $num < 10){
			echo "$num passed";
		}
	*/

	# SWITCH

	$favColor = 'yellow';

	switch($favColor){
		case 'red':
			echo 'Your favorite color is red';
			break;
		case 'blue':
			echo 'Your favorite color is blue';
			break;
		case 'green':
			echo 'Your favorite color is green';
			break;
		default:
			echo 'Your favorite color is something else';
	}
?>
<hr/>
<?php
<?php
//echo date('d');		// Day
//echo date('m');		// Month
//echo date('Y');		// Year
//echo date('l');		// Day of the week

//echo date('Y/m/d');
//echo date('m-d-Y');

//echo date('h');	// Hour
//echo date('i');	// Min
//echo date('s');	// Seconds
//echo date('a');	// AM or PM

// Set Time Zone
date_default_timezone_set('America/New_York');

//echo date('h:i:sa');

/*
Unix timestamp is a long integer containing the number of seconds between the Unix Epoch (January 1 1970 00:00:00 GMT) and the time specified.
*/

$timestamp = mktime(10, 14, 54, 9, 10, 1981);

//echo $timestamp;

//echo date('m/d/Y h:i:sa', $timestamp);

$timestamp2 = strtotime('7:00pm March 22 2016');
$timestamp3 = strtotime('tomorrow');
$timestamp4 = strtotime('next Sunday');
$timestamp5 = strtotime('+2 Days');

//echo $timestamp2;

echo date('m/d/Y h:i:sa', $timestamp5);
?>
?>

