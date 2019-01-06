<?php
    class Person{
        // proprietes key-value
        // methods function

        // public, private only in this cals, protected in this class and othe ather class related
        private $name;
        private $email;
        // const
        private static $agelimit = 40;

        // Metoda sigura cu construct 
        public function __construct($name, $email){
            $this->name = $name.'<br>';
            $this->email = $email.'<br>';
            echo __CLASS__.' create<br>';
        }
        // Deconstruct
        public function __destruct(){
            echo __CLASS__.' destroyed<br>';
        }
        /*
        // Methoda sigura este sa setam prop private si sa le apeleam cu o functie
        // si mai bine sa folosim construct ca mai sus 
         public function setName($name){
            $this->name = $name;
        }
         public function setEmail($email){
            $this->email = $email;
        }*/
        public function getName(){
            return $this->name;
        }
        public function getEmail(){
            return $this->email;
        }
        public static function getAgelimit(){
            return self::$agelimit;
        }
    }

// not good
// $person1->setName('Vlad Piciorea');

// $person1 = new Person('Vald P','sas@dda.com');
// echo $person1->getName();

// echo Person::$agelimit;
// sau
// echo Person::getAgelimit();


class Customer extends Person{
    private $balance;
    
    public function __construct($name, $email, $balance){
        // Chem constuctorul tata
        parent::__construct($name, $email, $balance);
        $this->balance = $balance;
        echo 'A new '.__CLASS__.' has been created'.'<br>';
        }

    public function setBalance($balance){
        $this->balance = $balance;
    }
    public function getBalance(){
        return $this->balance.'<br>';
    }
}
// $customer1 = new Customer('Vald P','sas@dda.com',200);

// echo $customer1->getBalance();