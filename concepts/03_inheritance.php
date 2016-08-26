<?php

class First{
    private $name;
    
    public function saySomething($word){
        echo $word;
    }
}

class Second extends First{
    public function getName() {
        echo $this->name;
    }
}

$second = new Second;
$second->name = 'Pan: ';
$second->getName();
$second->saySomething('Say Something Im giving up on you! <br>');
