<?php
spl_autoload_register(function($class_name){
   include 'classes/' .  $class_name . '.php'; 
});


$foo = new Foo();
$foo->sayFoo();

$bar = new Bar();
$bar->sayBar();

$bar->sayFooBar();

