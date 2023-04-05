<?php

class DBStatement extends PDOStatement {
    public $dbh;
    protected function __construct($dbh, $test) {
        $this->dbh = $dbh;
        var_dump($test);
    }
}

class Database extends PDO {
    function __construct($dsn, $username="", $password="", $driver_options=[]) {
        parent::__construct($dsn,$username,$password, $driver_options);
        $this->setAttribute(PDO::ATTR_STATEMENT_CLASS, [DBStatement::class, [$this, 1234]]);
    }
}


$db = new Database('mysql:host=127.0.0.2;dbname=test',$_ENV['DB_USER'],$_ENV['DB_PWD']);

$data = $db->query("SELECT * FROM test1")->fetchAll();

foreach ($data as $row) {
    echo $row['name']."\n";
}

