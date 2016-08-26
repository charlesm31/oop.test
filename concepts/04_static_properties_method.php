<?php

class User {

    public static $minPassLenghth = 5;

    public static function validatePassword($password) { // Static Method
        if (strlen($password) >= self::$minPassLenghth) {
            return true;
        }else{
            return false;
        }
    }
}

$password = 'failfsfs';

//  Use static method
if(User::validatePassword($password)){
    echo 'Password is valid <br>';
}else{
    echo 'Password invalid  <br>';
}

echo User::$minPassLenghth; //  Print static property
