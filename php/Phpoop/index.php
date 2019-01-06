<?php
class Users{
	public $username;
	public static $minPassLength = 5;

	public static function validatePass($password){
		if(strlen($password) >= self::$minPassLength){
			return true;
		}else{
			return false;
		}

	}
}

$password = 'pass';

if(Users::validatePass($password)){
    echo 'Password valid';
}else{
    echo 'Password invalid';
}

echo Users::$minPassLength;
?>
<hr>
<?php
// clasele abstracte pot fi doar extinse(class Name extends Animal) nu instentiate (new Animal)
abstract class Animal{
    public $name;
    public $color;

    public function describe(){
        return $this->name. ' is '.$this->color;
    }
    abstract public function makeSound();
}
class Duck extends Animal{
    public function describe(){
        return parent::describe();
    }

    public function makeSound(){
        return ' Quack';
    }
}
class Dog extends Animal{
    public function describe(){
        return parent::describe();
    }

    public function makeSound(){
        return 'Bark';
    }
}

$animal = new Duck();
$animal->name = 'Ben';
$animal->color = 'Yellow';
echo $animal->describe();
echo $animal->makeSound();
?>
<hr>
<?php
// Varianta 1
// include 'food.php';
// include 'bar.php';

// varianta2
// numele claselor trebuie sa fie asemanatoare cu numele fisierului .php ca sa functioneze
spl_autoload_register(function($class_name){
    include $class_name. '.php';
});

$foo = new Foo;
$bar = new Bar;

$foo->sayHello();
?>
<hr>
<?php
// object itereate
class People{
    public $person1 =  'Mike';
    public $person2 = 'Shelly';
    public $person3 = 'Jef';

    protected $person4 = 'jhon';
    private $person5 = 'Jen';

    // In modul acesta ne da toate valorile
    // function iterateObject(){
    //     foreach($this as $key => $value){
    //         print "$key => $value\n";

    //     }
    // }

}

$people = new People;

// Ne da doar valorile publice
foreach($this as $key => $value){
            print "$key => $value\n";

        }
// $people->iterateObject();
