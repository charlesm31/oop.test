<?php

class Database {

    //  Database Connection Properties
    private $host = 'localhost';
    private $user = 'root';
    private $pwd = 'Wc~045,j2';
    private $dbname = 'ionic3';
    //  Database handler, error handler and sql statement Properties
    private $dbh;
    private $error;
    private $stmt;

    //  Open Database connection
    public function __construct() {
        //  Set Databbse String Connection 
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        //  Set Database Options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        //  Create new PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pwd, $options);
        } catch (PDOException $e) {
            echo $this->error = $e->getMessage();
        }
    }

    //  Prepare database query
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    //  Check parameter values and assign datatype before updating database
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    //  Executes a query statement
    public function execute() {
        return $this->stmt->execute();
    }

    // Returns last interted ID
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

    //  Return query result in assoc array
    public function resultset() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function __destruct() {
        // Uninitialize query and database handler
        $this->stmt = null;
        $this->dbh = null;
    }

}
