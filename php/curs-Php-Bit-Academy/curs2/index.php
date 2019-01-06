<?php

namespace TestX;

    require_once 'Test.php';


 class Test {

     public $x;
     public $y;

     public function __construct() {
        //  echo 'test construct';
        // nu este corect
        //  $this::test3();
        // metoda buna
        // self::test3();
        // NU este corect
        // self::test1();
     }

     public function test1() {
         $this->x = 3;
        echo $this->x;
     }

     public function test2() {
         echo $this->y;
     }

    //  petru a acessa o functie fara sa initializez clasa
     public static function test3() {
         echo 'test';
        //  daca se foloseste this trebuie initializata clasa
     }
 }

//  :: face o operatiune statica
// -> face o operatiune dinamica


// $a = new Test;
//  Test::test3();

// se poate extinde doar o data
class Test2 extends Test {

    public function test1() {
        // suprascrie metoda din clasa parinte
        echo 'test1';
    }

    public function test2() {
        // suprascrie metoda din clasa parinte
        echo 'test1';
    }

    public function test1_old() {
        // chemarea unei metode(functii) din clasa parinte 
        parent::test1();
    }
// se executa la sfarsita
    public function  __destruct() {
        echo 'die';
    }

}

// $b = new Test2;
// $b->test1();
// $b->test1_old();

// clonare



abstract class Test3 {

    public $x;
    public$y;

    abstract public function test2($x = 3);

    public function test33() {
        echo "test";
    }
}

class Test4 extends Test3 {

    public function test2($n = 6) {
        echo 'abstract';
    }
}

// $c = new Test4;
// $c->test2();

interface Itest {
    public function x();
    public function y();
}

interface Itest2 {
    
    public function z();
}

class Test5 implements Itest, Itest2 {

    public function x() {
        echo 'interface';
    }

    public function y() {}
    public function z() {}

}

// $d = new Test5();
// $d->x();

// folosirea claselor care au nespace
// $f = new \TestA\Test3;

// pentru a doua forma
$f = new TestA\Test3;
$f->w();
