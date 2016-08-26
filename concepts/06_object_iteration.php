<?php
class People{
    public $person1 = 'Mike';
    public $person2 = 'Rea';
    public $person3 = 'Kimmy';
    protected $person4 = 'Haya';
    private $person5 = 'Junnee';
    
    public function iterateObject(){
        foreach($this as $key => $value){
            print "$key => $value <br>";
        }
    }
}

$people = new People;
$people->iterateObject();