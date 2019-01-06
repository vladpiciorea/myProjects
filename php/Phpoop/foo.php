<?php
    class Foo{
        // final inseamna ca nu mai poate fi rescrisa de o clasa extend cum este bar
        final public function sayHello(){
            echo 'Hello Word';
        }
    }