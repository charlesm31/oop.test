<?php

abstract class Animal { //  Abstract Class

    public $name;
    public $color;

    public function describe() {
        echo $this->name . ' is ' . $this->color . '!<br>';
    }

    abstract function makeSound();  //  Abstract Method
}

class Duck extends Animal{
    
    public function describe() {
        parent::describe(); // Inherted from parent abstract Class
    }
    
    public function makeSound() {
        echo 'Quack!';
    }
}

$animal = new Duck;
$animal->name = 'Ducky';
$animal->color = 'Yellow';
$animal->describe();
$animal->makeSound();
