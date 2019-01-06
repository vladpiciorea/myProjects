<?php
// Definire clasa
    class User {

        // proprietati (atribute)
        public $name;
        // Metode(functii)
        public function sayHello() {
            // Pentru accesare proprietate sau metoda din clasa se foloseste this 
            return '<br>Hello '. $this->name;
        }
    }

    // Instentiere un obiect din clasa User
    $user1 = new User();

    // Accesare proprietati publice
    // Proprietatilor publice li se pot atribi valori
    $user1->name = 'Vlad';
    echo $user1->name;
    // Accesare metode publice
    echo $user1->sayHello();

    // Creare alt obiect 
    $user1_2 = new User();
    $user1_2->name = 'Andrei';
    echo $user1_2->sayHello().' user1_2';
   
    echo '<hr>';
    echo '<br>';


    class User2 {

        public $name;
        public $age;

        // construct este o metoda ce ruleaza automat cand se instantiaza clasa
        public function __construct($name, $age) {

            // constanta speciala pe a vedea clasa
            echo 'Class '. __CLASS__ . ' instantiata<br>';
            // setarea proprietatilor din clasa cu valori
            $this->name = $name;
            $this->age = $age;
        }

        public function sayHello() {
            return $this->name. ' zice hello';
        }

        // destruct este o metoda folosita pentru a opri conexiunile cu db
        // Ruleaza cand dupa ultima instantiere a clasei
        // public function __destruct() {
        //     echo '<br>destruct run ..';
        // }
    }

    $user2 = new User2('Piciorea', 24);
    echo $user2->name . ' ' . $user2->age . ' ani. '. $user2->sayHello();

    echo '<hr>';
    echo '<br>';

    class User3 {

        private $name;
        private $age;

        public function __construct($name, $age) {

            $this->name = $name;
            $this->age = $age;

        }
        // Pt a accesa proprietatile si metodele private se creaza functii de get si set
        public function getName() {
            return $this->name . ' accesat ';
        }

        public function setName($name) {
            $this->name = $name . ' setat ';
        }

        // Se poat folosi metodele magice petru get si set proprietati private
        // __get MAGIC METHOD
        public function __get($property) {
            // veric daca exista proprietatea
            if(property_exists($this, $property)) {
                return $this->$property;
            }
        }

        // __set MAGIC METHOD
        public function __set($property, $value) {
            // veric daca exista proprietatea
            if(property_exists($this, $property)) {
                $this->$property = $value;
            }
            return $this;

        }

    }

    $user3 = new User3('Liliana', 45);
    // acesare proprietati priv
    echo $user3->getName();
    // setare prop private
    echo $user3->setName('Ion');
    echo '<br>';
    echo $user3->getName();
    echo '<br>';
    // accesare cu functia magica get
    echo $user3->__get('age');
    echo '<br>';
    // setare cu functia magica set
    $user3->__set('age', 48);
    echo $user3->__get('age');

    echo '<hr>';
    echo '<br>';

    class User4 {
        protected $name;
        protected $age;

        public function __construct($name, $age) {
            $this->name = $name;
            $this->age = $age;
        }
    }

    class Customer extends User4 {
        private $balance;
         public function __construct($name,$age,$balance) {
            //  Pentru a nu repeta sintaha cu this din clasa parinte
            // se cheama metoda construct din parent
            parent::__construct($name,$age);
             $this->balance = $balance;
         }
        public function pay($amount) {
            return $this->name. ' a platit '. $amount .' Lei';
        }

        public function getBalance() {
            return $this->balance;
        }
    }

    $customer1 = new Customer('Maria', 21, 500);
    echo $customer1->pay(100);
    echo ' Credit total '. $customer1->getBalance();

    echo '<hr>';
    echo '<br>';

    // Proprietati statice
    // o prop sau o metoda statica se poate apela fara a instantia clasa respectiva
    class User5 {
        public $name;
        public $age;
        public static $minPassLength = 6;

        public static function validatePass($pass) {
            // se aceseaza cu selef o prop/metoda statica
            if(strlen($pass) >= self::$minPassLength) {
                return true;
            }else {
                return false;
            }
        }
    }

    // Se poat folosi prop/metodele statrice fara a instantia clasa
    $password = 'hello1';
    if(User5::validatePass($password)) {
        echo 'Parola valida';
    }else {
        echo 'Parola invalida';
    }