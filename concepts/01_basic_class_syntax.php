<?php

class User {
    private $username;
    private $password;

    public function __construct($username, $password) {
        echo '<strong>Contructor called</strong>: This can be used for opening db connection, or initializing properties. <br>';
        $this->username = $username;
        $this->password = $password;        
    }

    public function register() {
        echo $this->username . ' is registered! <br>';
    }

    public function login() {
        $this->auth_user();
    }

    public function auth_user() {
        echo $this->username . ' is authenticated! <br>';
    }
    
    public function __destruct() {
        echo '<strong>Destructor called</strong>: This can be used for closing db connection <br>';
    }

}

$username = 'Jeremy';
$password = 'pass123';

//  Instantiate Object
$user = new User($username, $password);

//  Call Methods  
$user->register();
$user->login();

//echo $user->username . '<br>'; // Access variables from User Class


